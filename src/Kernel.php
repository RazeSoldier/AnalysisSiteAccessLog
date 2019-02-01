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

use RazeSoldier\GetSiteViewCount\Strategy\StrategyFactory;

class Kernel
{
    /**
     * @var \SplFileObject
     */
    private $file;

    /**
     * Boot kernel
     */
    public function __construct()
    {
        if (CommandOption::getInstance()->has('f')) {
            $filePath = CommandOption::getInstance()->get('f');
        } elseif (CommandOption::getInstance()->has('file')) {
            $filePath = CommandOption::getInstance()->get('file');
        } else {
            throw new \Exception('Missing required option: -f/--file');
        }
        $this->file = new \SplFileObject($filePath, 'r');
    }

    public function run()
    {
        $strategy = StrategyFactory::make($this->file, CommandOption::getInstance());
        $strategy->run();
    }
}