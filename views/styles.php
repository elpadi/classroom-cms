<?php
$cssIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(BASE_DIR.'/assets/css'));
foreach ($cssIterator as $file)
	if (!$file->isDir()) printf('<link rel="stylesheet" href="%s">', str_replace(BASE_DIR, '', $file->getPathname()));
