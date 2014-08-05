<?php

class CalendarWidget extends CWidget
{
    // Месяцы
    private $month_names = array(
        'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
    );

    public function run()
    {
        
        $year = Yii::app()->request->getQuery('y', date('Y'));
        $month = Yii::app()->request->getQuery('m', date('m'));
        
        if ($year < 1970 OR $year > 2037){
            $year = date("Y");
        }
        
        if ($month < 1 OR $month > 12){
            $month = date("m");
        }

        $month_stamp = mktime(0, 0, 0, $month, 1, $year);
        
        $day_count = date("t", $month_stamp);
        $weekday = date("w", $month_stamp);
        
        if ($weekday == 0){
            $weekday = 7;
        }
        
        $start = -($weekday - 2);
        $last = ($day_count + $weekday - 1) % 7;

        if ($last == 0){
            $end = $day_count;
        }else{
            $end = $day_count + 7 - $last;
        }

        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('date', date('Y-m-d H:i:s', strtotime($year . '-' . $month . '-01 00:00:00')), date('Y-m-d H:i:s', strtotime($year . '-' . $month . '-' . $day_count . ' 23:59:59')));
        $results = Events::model()->findAll($criteria);
        
        $events = array();
        if($results)
        {
            foreach ($results as $result)
            {
                $events[strtotime(date('Y-m-d', strtotime($result['date'])))][$result['id']] = array(
                    'date' => $result['date'],
                    'title' => $result['title'],
                    'description' => $result['description'],
                );
            }
            
        }
        
        $this->render('calendar', array(
            'prev'      => date('?\m=m&\y=Y', mktime(0, 0, 0, $month - 1, 1, $year)),
            'next'      => date('?\m=m&\y=Y', mktime(0, 0, 0, $month + 1, 1, $year)),
            'current_date'     => $this->month_names[$month - 1] . ", " . $year,
            'year'      => $year,
            'month'     => $month,
            'start'     => $start,
            'end'       => $end,
            'day_count' => $day_count,
            'events'    => $events
                )
        );
    }

}
