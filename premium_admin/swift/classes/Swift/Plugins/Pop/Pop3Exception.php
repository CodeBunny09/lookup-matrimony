<?php

/*
 Pop3Exception from Swift Mailer.
 
 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
 
 */

//@require 'Swift/IoException.php';

/**
 * Pop3Exception thrown when an error occurs connecting to a POP3 host.
 * 
 * @package Swift
 * @subpackage Transport
 * 
 * @author Chris Corbyn
 */
class Swift_Plugins_Pop_Pop3Exception extends Swift_IoException
{
  
  /**
   * Create a new Pop3Exception with $message.
   * 
   * @param string $message
   */
  public function __construct($message)
  {
    parent::__construct($message);
  }
  
}
