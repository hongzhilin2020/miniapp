<?php
/**
 * Description: 流年
 * Author: qiubin
 * File: LiuNian.php
 * DataTime: 2020/11/11 3:09 下午
 */

namespace App\Model\Logic\nlf\calendar;
use App\Model\Logic\nlf\calendar\util\LunarUtil;

class LiuNian
{
    /**
     * 序数，0-9
     * @var int
     */
    private $index;

    /**
     * 大运
     * @var DaYun
     */
    private $daYun;

    /**
     * 年
     * @var int
     */
    private $year;

    /**
     * 年龄
     * @var int
     */
    private $age;

    /**
     * 阴历
     * @var Lunar
     */
    private $lunar;

    /**
     * 初始化
     * @param int $index
     * @param DaYun $daYun
     */
    public function __construct(DaYun $daYun, $index)
    {
        $this->daYun = $daYun;
        $this->lunar = $daYun->getLunar();
        $this->index = $index;
        $this->year = $daYun->getStartYear() + $index;
        $this->age = $daYun->getStartAge() + $index;
    }

    /**
     * 获取序数
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * 获取大运
     * @return DaYun
     */
    public function getDaYun()
    {
        return $this->daYun;
    }

    /**
     * 获取年
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * 获取年龄
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * 获取阴历
     * @return Lunar
     */
    public function getLunar()
    {
        return $this->lunar;
    }

    /**
     * 获取干支
     * @return string
     */
    public function getGanZhi()
    {
        $offset = LunarUtil::getJiaZiIndex($this->lunar->getYearInGanZhiExact()) + $this->index;
        if ($this->daYun->getIndex() > 0) {
            $offset += $this->daYun->getStartAge() - 1;
        }
        $offset %= count(LunarUtil::$JIA_ZI);
        return LunarUtil::$JIA_ZI[$offset];
    }

    /**
     * 获取流月
     * @return LiuYue[]
     */
    public function getLiuYue()
    {
        $n = 12;
        $l = array();
        for ($i = 0; $i < $n; $i++) {
            $l[] = new LiuYue($this, $i);
        }
        return $l;
    }

}
