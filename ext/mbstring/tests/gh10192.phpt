--TEST--
GH-10192 (mb_detect_encoding() results for UTF-7 differ between PHP 8.0 and 8.1)
--EXTENSIONS--
mbstring
--FILE--
<?php

echo "'A + B':\n";
echo "mb_detect_encoding: ";
echo mb_detect_encoding('A + B', 'UTF-8, UTF-7', true);
echo "\n";
echo "mb_check_encoding:  ";
var_dump(mb_check_encoding('A + B', 'UTF-7'));

echo "\n'A - B':\n";
echo "mb_detect_encoding: ";
echo mb_detect_encoding('A - B', 'UTF-8, UTF-7', true);
echo "\n";
echo "mb_check_encoding:  ";
var_dump(mb_check_encoding('A - B', 'UTF-7'));
?>
--EXPECT--
'A + B':
mb_detect_encoding: UTF-8
mb_check_encoding:  bool(false)

'A - B':
mb_detect_encoding: UTF-8
mb_check_encoding:  bool(true)
