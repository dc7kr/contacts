<?php
/**
 * Copyright (c) 2012 Thomas Tanghus <thomas@tanghus.net>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */


OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('contacts');
OCP\JSON::callCheck();

require_once __DIR__.'/../loghandler.php';

$categoryid = isset($_POST['categoryid']) ? $_POST['categoryid'] : null;
$contactids = isset($_POST['contactids']) ? $_POST['contactids'] : null;

if(is_null($categoryid)) {
	bailOut(OCA\Contacts\App::$l10n->t('Group ID missing from request.'));
}

if(is_null($contactids)) {
	bailOut(OCA\Contacts\App::$l10n->t('Contact ID missing from request.'));
}

debug('id: ' . print_r($contactids, true) .', categoryid: ' . $categoryid);

$catmgr = OCA\Contacts\App::getVCategories();

foreach($contactids as $contactid) {
	$catmgr->addToCategory($contactids, $categoryid);
}

OCP\JSON::success();
