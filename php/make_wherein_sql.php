<?php

$mail_list = require_once "./data/mail_list.php";

$list = implode("', '", $mail_list);

$sql = "SELECT * FROM  `email_queues` WHERE `to` IN('".
        $list.
        "') ORDER BY  `email_queues`.`id` DESC";

print_r($sql);

/*

$update = "UPDATE  `openmaster`.`email_queues` SET  `retry` =  '1' WHERE  `email_queues`.`id` IN(609,589,568,567,566,565,564,563,562,561,560,559,558,557,556,555,554,553,552,551,550,549,548,547,546,545,544,543)";
542,541,540,539,538,537,536,535,534,533,532,531,530,529,528,527,526,525,524,523,522,521,520,519,518,517,516,515
514,513,512,511,510,509,508,507,506,505,504,503,502,501,500,499,498,497,496,495,494,493,492,491,490,489,488

487,486,485,482,433,287,286,177,23

select * from `openmaster`.`email_queues` WHERE  `email_queues`.`id` IN(542,541,540,539,538,537,536,535,534,533,532,531,530,529,528,527,526,525,524,523,522,521,520,519,518,517,516,515);

UPDATE  `openmaster`.`email_queues` SET  `retry` =  '0' WHERE  `email_queues`.`id` IN(609,589,568,5    67,566,565,564,563,562,561,560,559,558,557,556,555,554,553,552,551,550,549,548,547,546,545,544,543);

UPDATE  `openmaster`.`email_queues` SET  `retry` =  '0' WHERE  `email_queues`.`id` IN(542,541,540,539,538,537,536,535,534,533,532,531,530,529,528,527,526,525,524,523,522,521,520,519,518,517,516,515);

 */
