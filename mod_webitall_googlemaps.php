<?php
/**
 * @copyright	@copyright	Copyright (c) 2014 Webitall (www.webitall.dk). All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$options = new JRegistry;
$options->set('autoload', $params->get('framework'));
$google = new JGoogle($options);

$map = $google->embed('maps');
$map->setAutoload('jquery');
$map->setZoom($params->get('zoom'));
$map->setMapID($params->get('id'));
$map->setMapClass($params->get('class'));
$map->setMaptype($params->get('maptype'));

$markers = json_decode($params->get('markers'));

foreach($markers->address AS $key => $address) {
    $map->addMarker($address);

    if ($markers->setcenter[$key]) {
        $map->setCenter($address);
    }
}

$map->echoHeader();

$class_sfx = htmlspecialchars($params->get('class_sfx'));

require(JModuleHelper::getLayoutPath('mod_webitall_googlemaps', $params->get('layout', 'default')));