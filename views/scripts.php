<?php
$jsIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(BASE_DIR.'/assets/js'));
foreach ($jsIterator as $file)
	if (!$file->isDir()) printf('<script src="%s"></script>', str_replace(BASE_DIR, '', $file->getPathname()));
