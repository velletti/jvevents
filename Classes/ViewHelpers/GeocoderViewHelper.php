<?php
namespace JVE\JvEvents\ViewHelpers;
/***************************************************************
 * Copyright notice
 *
 * (c) 2011-13 Sebastian Fischer <typo3@evoweb.de>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Viewhelper to render a selectbox with values
 * in given steps from start to end value
 *
 * <code title="Usage">
 * {namespace register=\JVE\JvEvents\\iewHelpers}
 * <register:form.required fieldName="'username"/>
 * </code>
 */
class GeocoderViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper   {

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Needed as child node's output can return a DateTime object which can't be escaped
     *
     * @var bool
     */
    protected $escapeChildren = false;

    public function __initialize() {
        $this->registerArgument('location', 'Object', 'Single location', false);
    }



    /**
     * Render a special sign if the field is required
     *
     * @param \JVE\JvEvents\Domain\Model\Location $location Single location
     * @return string
     */
    public function render($location) {
        /** @var \JVE\JvEvents\Utility\Geocoder $geoCoder */
        $geoCoder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("JVE\\JvEvents\\Utility\\Geocoder") ;
        $formfieldIds["address"] = '#streetAndNr' ;
        $formfieldIds["zip"] = '#zip' ;
        $formfieldIds["city"] = '#city' ;
        $formfieldIds["country"] = '#country' ;

        $formfieldIds["return"]["lat"] = "#lat" ;
        $formfieldIds["return"]["lng"] = "#lng" ;
        $return = $geoCoder->javascriptCode ;

        $return .= $geoCoder->main(false , $location->getUid() ,"jQuery" , $formfieldIds ) ;

        return $return ;
    }
}
