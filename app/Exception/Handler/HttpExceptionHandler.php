<?php declare(strict_types=1);

namespace App\Exception\Handler;

use Swoft\Task\Exception\TaskException as TaskExceptionAlias;
use Swoft\Task\Task;
use const APP_DEBUG;
use function get_class;
use function sprintf;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;
use Throwable;

/**
 * Class HttpExceptionHandler
 *
 * @ExceptionHandler(\Throwable::class)
 */
class HttpExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $e
     * @param Response $response
     * @return Response
     * @throws TaskExceptionAlias
     */
    public function handle(Throwable $e, Response $response): Response
    {
        // Log
        Log::error($e->getMessage());
        CLog::error($e->getMessage());

        $errMsg = $e->getMessage();

        // 生产环境下过滤敏感信息
        if(!APP_DEBUG && (strrpos($errMsg, 'SQLSTATE') || strrpos($errMsg, 'database'))){
            $errMsg = 'Unknown error.';
        }

        $file = substr($e->getFile(), 0, -4);
        $result = [
            'status' => false,
            'data' => [],
            'error' => [
                'code' => $e->getCode(),
                'message' => APP_DEBUG ? sprintf('(%s) %s', get_class($e), $errMsg) : $errMsg,
                'file' => sprintf('At %s line %d', substr($file, strrpos($file, '/') + 1), $e->getLine()),
            ],
        ];

        // Debug is false
        if (!APP_DEBUG) {
            $content = $result['error'];
            $content['file'] = sprintf('At %s line %d', $e->getFile(), $e->getLine());
            $content['trace'] = $e->getTraceAsString();

            //send error info to administrator with email
            $r = context()->getRequest();
            $data['Header'] = $r->header();
            $data['Ip'] = $r->server('remote_addr');
            $data['Method'] = $r->server('request_method');
            $data['Request'] = $r->getQueryParams();
            $data['Input'] = $r->input();
            $data['Time'] = $r->getRequestTime();
            $data['PathInfo'] = $r->server('path_info');
            $data['Query'] = $r->query();
            $data['IsAjax'] = $r->isAjax();
            $data['Scheme'] = $r->server('server_protocol');
            //Task::async('email', 'send', [['content' => $content, 'attach' => $data]]);

            return $response->withStatus(200)->withData($result);
        }

        // Debug is true
        $result['error']['file'] = sprintf('At %s line %d', $e->getFile(), $e->getLine());
        $result['error']['trace'] = $e->getTraceAsString();

        return $response->withData($result);
    }
}
