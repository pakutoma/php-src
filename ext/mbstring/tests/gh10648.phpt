--TEST--
GH-10648 (mb_check_encoding() returns true for incorrect but interpretable ISO-2022-JP byte sequences)
--EXTENSIONS--
mbstring
--FILE--
<?php

$jis_bytes = '1b244224221b2842'; // 'あ' in ISO-2022-JP
$jis_bytes_without_esc = '1b24422422'; // 'あ' in ISO-2022-JP without trailing escape sequence

$esc_kana = '1b2849211b2842'; // 'ｱ' in ISO-2022-JP (JIS X 0201 7bit kana with escape sequence)
$so_kana = '0e210f'; // 'ｱ' in ISO-2022-JP (JIS X 0201 7bit kana with SO/SI)
$gr_kana = 'b1'; // 'ｱ' in ISO-2022-JP (JIS X 0201 8bit kana)

// Testing for trailing escape sequence
var_dump(mb_check_encoding(hex2bin($jis_bytes), 'JIS'));
var_dump(mb_check_encoding(hex2bin($jis_bytes_without_esc), 'JIS')); // false

// Testing for JIS X 0201 kana
var_dump(mb_check_encoding(hex2bin($esc_kana), 'JIS'));
var_dump(mb_check_encoding(hex2bin($so_kana), 'JIS'));
var_dump(mb_check_encoding(hex2bin($gr_kana), 'JIS')); // false
?>
--EXPECT--
bool(true)
bool(false)
bool(true)
bool(true)
bool(false)
