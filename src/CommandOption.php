<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace RazeSoldier\GetSiteViewCount;

/**
 * Used to get the command options
 * @package RazeSoldier\GetSiteViewCount
 */
class CommandOption
{
    const OPTIONS = 'f:';
    const LONGOPTS = [
        'file:'
    ];

    private static $instance;

    private $options;

    private function __construct()
    {
        $this->options = getopt(self::OPTIONS, self::LONGOPTS);
    }

    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function get(string $key)
    {
        if (!$this->has($key)) {
            return null;
        }
        return $this->options[$key];
    }

    public function has(string $key) : bool
    {
        return isset($this->options[$key]);
    }
}