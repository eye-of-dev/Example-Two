<div class="calendar">
    <table>
        <tr>
            <td colspan="7">
                <table class="title">
                    <tr>
                        <td align="left"><a href="<?php print $prev; ?>">Прев.</a></td>
                        <td align="center"><?php print $current_date; ?></td>
                        <td align="right"><a href="<?php print $next; ?>">След.</a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="week_title">
            <td>Пн.</td>
            <td>Вт.</td>
            <td>Ср.</td>
            <td>Чт.</td>
            <td>Пт.</td>
            <td>Сб.</td>
            <td>Вс.</td>
        <tr>
        <?php $i = 0; ?>
        <?php for ($d = $start; $d <= $end; $d++): ?>
            <?php if( ! ($i++ % 7) ): ?>
                <tr class="cal_row">
            <?php endif; ?>
            
            <?php if( $d < 1 OR $d > $day_count ): ?>
                    <td align="center" id="snaptarget_'<?php print $d; ?>" class="empty">&nbsp</td>
            <?php else:?>
                    <td align="center" id="snaptarget_'<?php print $d; ?>" class="ui-widget-header <?php print (date('Y-m-d', strtotime($year . '-' . $month . '-' . $d)) == date('Y-m-d', time())) ? 'current' : ''; ?>" data-date="<?php print date('Y-m-d', strtotime($year . '-' . $month . '-' . $d)); ?>">
                        <a href="javascript:void(0);" class="add_event" data-date="<?php print date('Y-m-d', strtotime($year . '-' . $month . '-' . $d)); ?>"><?php print $d; ?></a>
                        <?php if(isset($events[strtotime($year . '-' . $month . '-' . $d)])): ?>
                        <ul>
                            <?php foreach ($events[strtotime($year . '-' . $month . '-' . $d)] as $key => $event): ?>
                            <li class="draggable" data-id="<?php print $key; ?>">
                                <a class="open-event" data-id="<?php print $key; ?>" id="open-event-<?php print $key; ?>" href="javascript:void(0);" title="<?php print $event['description']; ?>"><?php print $event['title']; ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </td>
            <?php endif; ?>
                    
            <?php if( ! ($i % 7) ): ?>
                </tr>
            <?php endif; ?>
        <?php endfor; ?>
    </table>
    
</div>