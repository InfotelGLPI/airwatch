<?php
/*
 * @version $Id$
 LICENSE

  This file is part of the Airwatch plugin.

 Order plugin is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Airwatch plugin is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; along with Airwatch. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 @package   airwatch
 @author    Teclib'
 @copyright Copyright (c) 2016 Teclib'
 @license   GPLv2+
            http://www.gnu.org/licenses/gpl.txt
 @link      https://github.com/pluginsglpi/airwatch
 @link      http://www.glpi-project.org/
 @since     2016
 ---------------------------------------------------------------------- */

define ('AIRWATCH_API_RESULT_OK',    'ok');
define ('AIRWATCH_API_RESULT_ERROR', 'ko');

function plugin_init_airwatch() {
   global $PLUGIN_HOOKS,$CFG_GLPI,$LANG;
   $PLUGIN_HOOKS['csrf_compliant']['airwatch'] = true;

   $plugin = new Plugin();
   if ($plugin->isActivated('airwatch')) {
      $PLUGIN_HOOKS['config_page']['airwatch'] = 'front/config.form.php';
   }
}

function plugin_version_airwatch() {
   global $LANG;

   return array ('name'           => __("GLPi Airwatch Connector", 'airwatch'),
                   'version'        => '0.90+1.0',
                   'author'         => "<a href='http://www.teclib.com'>Teclib'</a>",
                   'license'        => 'GPLv2+',
                   'homepage'       => 'https://github.com/pluginsglpi/airwatch',
                   'minGlpiVersion' => "0.90");
}

function plugin_airwatch_check_prerequisites() {
   if (version_compare(GLPI_VERSION, '0.90', 'lt')) {
      echo "This plugin requires GLPI 0.90 or higher";
      return false;
   }

   return true;
}

function plugin_airwatch_check_config() {
   if (!function_exists('curl_init')) {
      echo "cURL extension (PHP) is required.";
      return false;
   }
   $plugin = new Plugin();
   if (!$plugin->isActivated('fusioninventory')) {
      echo "Fusioninventory plugin must be enabled";
      return false;
   }

   return true;
}
?>