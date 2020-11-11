<?php declare(strict_types=1);


namespace App\Controller;

use App\Model\Logic\nlf\calendar\Lunar;
use App\Model\Logic\nlf\calendar\NineStar;
use App\Model\Logic\nlf\calendar\Solar;
use App\Model\Logic\nlf\calendar\util\HolidayUtil;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * Class TestController
 *
 * @since 2.0
 *
 * @Controller(prefix="test")
 */
class TestController
{
    /**
     * @RequestMapping(route="index")
     *
     * @return array
     * @throws \Exception
     */
    public function index(): array
    {
        $info = [];

        //$lunar = Lunar::fromYmdHms(1983, 8, 7, 16);
        $data = date_create('1983-09-13 16:30:00');
        $lunar = Lunar::fromDate($data);
        echo $lunar->toFullString() . "\n";
        echo $lunar->getSolar()->toFullString() . "\n";
        echo $lunar->getXiuSong() . "\n";
        print_r($lunar->getBaZi()) . "\n";
        print_r($lunar->getBaZiShiShenGan()) . "\n";

        print_r($lunar->getBaZiWuXing()) . "\n";
        print_r($lunar->getBaZiNaYin()) . "\n";
        print_r($lunar->getBaZiShiShenZhi()) . "\n";

        print_r($lunar->getBaZiShiShenYearZhi()) . "\n";
        print_r($lunar->getBaZiShiShenMonthZhi()) . "\n";
        print_r($lunar->getBaZiShiShenDayZhi()) . "\n";
        print_r($lunar->getBaZiShiShenTimeZhi()) . "\n";

        print_r($lunar->getYearGan()) . "\n";


//        // 节假日
//        echo HolidayUtil::getHoliday('2020-05-02') . "\n";
//
//        // 儒略日
//        $solar = Solar::fromYmd(2020, 7, 15);
//        echo $solar->getJulianDay() . "\n";
//
//        $solar = Solar::fromJulianDay(2459045.5);
//        echo $solar->toFullString() . "\n";
//
//        // 遍历节气表
//        $lunar = Lunar::fromDate(new \DateTime());
//        $jieQi = $lunar->getJieQiTable();
//        foreach ($jieQi as $key => $value) {
//            echo $key . ' = ' . $value->toYmdHms() . "\n";
//        }
//
//        // 遍历日吉神（宜趋）
//        foreach ($lunar->getDayJiShen() as $js) {
//            echo $js . ' ';
//        }
//        echo "\n";
//
//        // 遍历时辰宜
//        foreach ($lunar->getTimeYi() as $yi) {
//            echo $yi . ' ';
//        }
//        echo "\n";
//
//        // 八字
//        $baZi = $lunar->getEightChar();
//        echo $baZi . ' ';
//        echo "\n";
//
//        // 八字五行
//        echo $baZi->getYearWuXing() . ' ' . $baZi->getMonthWuXing() . ' ' . $baZi->getDayWuXing() . ' ' . $baZi->getTimeWuXing();
//        echo "\n";
//
//        // 八字纳音
//        echo $baZi->getYearNaYin() . ' ' . $baZi->getMonthNaYin() . ' ' . $baZi->getDayNaYin() . ' ' . $baZi->getTimeNaYin();
//        echo "\n";
//
//        // 八字天干十神
//        echo $baZi->getYearShiShenGan() . ' ' . $baZi->getMonthShiShenGan() . ' ' . $baZi->getDayShiShenGan() . ' ' . $baZi->getTimeShiShenGan();
//        echo "\n";
//
//        // 遍历八字年支十神
//        foreach ($baZi->getYearShiShenZhi() as $shen) {
//            echo $shen . ' ';
//        }
//        echo "\n";
//
//        // 遍历八字月支十神
//        foreach ($baZi->getMonthShiShenZhi() as $shen) {
//            echo $shen . ' ';
//        }
//        echo "\n";
//
//        // 遍历八字日支十神
//        foreach ($baZi->getDayShiShenZhi() as $shen) {
//            echo $shen . ' ';
//        }
//        echo "\n";
//
//        // 遍历八字时支十神
//        foreach ($baZi->getTimeShiShenZhi() as $shen) {
//            echo $shen . ' ';
//        }
//        echo "\n";
//
//        // 八字胎元
//        echo $baZi->getTaiYuan();
//        echo "\n";
//
//        // 八字命宫
//        echo $baZi->getMingGong();
//        echo "\n";
//
//        // 八字身宫
//        echo $baZi->getShenGong();
//        echo "\n";
//
//        // 时辰吉神方位
//        echo $lunar->getTimePositionFu() . "\n";
//        echo $lunar->getTimePositionXi() . "\n";
//        echo $lunar->getTimePositionCai() . "\n";
//        echo $lunar->getTimePositionYinGui() . "\n";
//        echo $lunar->getTimePositionYangGui() . "\n";
//
//        echo $lunar->getTimePositionFuDesc() . "\n";
//        echo $lunar->getTimePositionXiDesc() . "\n";
//        echo $lunar->getTimePositionCaiDesc() . "\n";
//        echo $lunar->getTimePositionYinGuiDesc() . "\n";
//        echo $lunar->getTimePositionYangGuiDesc() . "\n";
//
//        // 指定阳历时间得到八字信息
//        $solar = Solar::fromYmdHms(1983, 9, 13, 16, 0, 0);
//        $lunar = $solar->getLunar();
//        $baZi = $lunar->getEightChar();
//        echo $baZi->getYear() . ' ' . $baZi->getMonth() . ' ' . $baZi->getDay() . ' ' . $baZi->getTime() . "\n";
//
//        $solar = Solar::fromYmdHms(1983, 9, 13, 16, 0, 0);
//        $lunar = $solar->getLunar();
//        $baZi = $lunar->getEightChar();
//
//        // 男运
//        $yun = $baZi->getYun(1);
//
//        echo "\n";
//        echo '阳历' . $solar->toYmdHms() . '出生\n';
//        echo '出生' . $yun->getStartYear() . '年' . $yun->getStartMonth() . '个月' . $yun->getStartDay() . '天后起运' . "\n";
//        echo '阳历' . $yun->getStartSolar()->toYmd() . '后起运' . "\n";
//
//        echo "\n";
//
//        // 大运
//        $daYunArr = $yun->getDaYun();
//        for ($i = 0; $i < count($daYunArr); $i++) {
//            $daYun = $daYunArr[$i];
//            echo '大运[' . $daYun->getIndex() . '] = ' . $daYun->getStartYear() . '年 ' . $daYun->getStartAge() . '岁 ' . $daYun->getGanZhi() . "\n";
//        }
//
//        echo "\n";
//
//        // 第1次大运流年
//        $liuNianArr = $daYunArr[1]->getLiuNian();
//        for ($i = 0; $i < count($liuNianArr); $i++) {
//            $liuNian = $liuNianArr[$i];
//            echo '流年[' . $liuNian->getIndex() . '] = ' . $liuNian->getYear() . '年 ' . $liuNian->getAge() . '岁 ' . $liuNian->getGanZhi() . "\n";
//        }
//
//        echo "\n";
//
//        // 第1次大运小运
//        $xiaoYunArr = $daYunArr[1]->getXiaoYun();
//        for ($i = 0; $i < count($xiaoYunArr); $i++) {
//            $xiaoYun = $xiaoYunArr[$i];
//            echo '小运[' . $xiaoYun->getIndex() . '] = ' . $xiaoYun->getYear() . '年 ' . $xiaoYun->getAge() . '岁 ' . $xiaoYun->getGanZhi() . "\n";
//        }
//
//        echo "\n";
//
//        // 第1次大运首个流年的流月
//        $liuYueArr = $liuNianArr[0]->getLiuYue();
//        for ($i = 0; $i < count($liuYueArr); $i++) {
//            $liuYue = $liuYueArr[$i];
//            echo '流月[' . $liuYue->getIndex() . '] = ' . $liuYue->getMonthInChinese() . '月 ' . $liuYue->getGanZhi() . "\n";
//        }
//
//        echo "\n";
//
//        // 八字转阳历
//        try {
//            $l = Solar::fromBaZi('庚子', '癸未', '乙丑', '丁亥');
//            foreach ($l as $d) {
//                echo $d->toFullString() . "\n";
//            }
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
//
//        // 阳历日期推移
//        $date = Solar::fromYmd(2020, 1, 23);
//        echo strcmp('2020-01-24', $date->next(1)->toYmd());
//
//        // 仅工作日，跨越春节假期
//        echo strcmp('2020-02-03', $date->nextWorkday(1)->toYmd());
//
//        $date = Solar::fromYmd(2020, 2, 3);
//        echo strcmp('2020-01-31', $date->next(-3)->toYmd());
//
//        // 仅工作日，跨越春节假期
//        echo strcmp('2020-01-21', $date->nextWorkday(-3)->toYmd());
//
//        $date = Solar::fromYmd(2020, 2, 9);
//        echo strcmp('2020-02-15', $date->next(6)->toYmd());
//
//        // 仅工作日，跨越周末
//        echo strcmp('2020-02-17', $date->nextWorkday(6)->toYmd());
//
//        $date = Solar::fromYmd(2020, 1, 17);
//        echo strcmp('2020-01-18', $date->next(1)->toYmd());
//
//        // 仅工作日，周日调休按上班算
//        echo strcmp('2020-01-19', $date->nextWorkday(1)->toYmd()) . "\n";
//
//        // 节假日数据修改
//        echo strcmp('2020-01-01 元旦节 2020-01-01', HolidayUtil::getHoliday('2020-01-01') . '');
//
//        // 将2020-01-01修改为春节
//        HolidayUtil::fix(null, '202001011120200101');
//        echo strcmp('2020-01-01 春节 2020-01-01', HolidayUtil::getHoliday('2020-01-01') . '');
//
//        // 追加2099-01-01为元旦节
//        HolidayUtil::fix(null, '209901010120990101');
//        echo strcmp('2099-01-01 元旦节 2099-01-01', HolidayUtil::getHoliday('2099-01-01') . '');
//
//        // 将2020-01-01修改为春节，并追加2099-01-01为元旦节
//        HolidayUtil::fix(null, '202001011120200101209901010120990101');
//        echo strcmp('2020-01-01 春节 2020-01-01', HolidayUtil::getHoliday('2020-01-01') . '');
//        echo strcmp('2099-01-01 元旦节 2099-01-01', HolidayUtil::getHoliday('2099-01-01') . '');
//
//        // 更改节假日名称
//        $names = HolidayUtil::$NAMES;
//        $names[0] = '元旦';
//        $names[1] = '大年初一';
//
//        HolidayUtil::fix($names, null);
//        echo strcmp('2020-01-01 大年初一 2020-01-01', HolidayUtil::getHoliday('2020-01-01') . '');
//        echo strcmp('2099-01-01 元旦 2099-01-01', HolidayUtil::getHoliday('2099-01-01') . '');
//
//        // 追加节假日名称和数据
//        $names = array();
//        for ($i = 0, $j = count(HolidayUtil::$NAMES); $i < $j; $i++) {
//            $names[$i] = HolidayUtil::$NAMES[$i];
//        }
//        $names[9] = '我的生日';
//        $names[10] = '结婚纪念日';
//        $names[11] = '她的生日';
//
//        HolidayUtil::fix($names, '20210529912021052920211111:12021111120211201;120211201');
//        echo strcmp('2021-05-29 我的生日 2021-05-29', HolidayUtil::getHoliday('2021-05-29') . '');
//        echo strcmp('2021-11-11 结婚纪念日 2021-11-11', HolidayUtil::getHoliday('2021-11-11') . '');
//        echo strcmp('2021-12-01 她的生日 2021-12-01', HolidayUtil::getHoliday('2021-12-01') . '') . "\n";

        return [

        ];
    }
}
