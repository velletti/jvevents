<?php
namespace JVE\JvEvents\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Jörg velletti <jVelletti@allplan.com>, Allplan GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * The repository for Organizers
 */
class OrganizerRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => QueryInterface::ORDER_ASCENDING
    );

    public function findByUidAllpages($uid , $toArray=TRUE , $ignoreEnableFields = TRUE )
    {
        $query = $this->createQuery();
        $querySettings = $query->getQuerySettings() ;
        $querySettings->setRespectStoragePage(false);
        $querySettings->setRespectSysLanguage(FALSE);
        $querySettings->setIgnoreEnableFields($ignoreEnableFields) ;
        $query->setQuerySettings($querySettings) ;

        $query->setLimit(1) ;

        $query->matching( $query->equals('uid', $uid ) ) ;
        $res = $query->execute() ;
        // $this->debugQuery($query) ;
        if( $toArray === TRUE ) {
            return $res->toArray(); // TODO: Change the autogenerated stub
        } else {
            return $res->getFirst() ;
        }
    }

    /**
     * @param integer $user UID of the User
     * @param bool $toArray Result as QueryInterface or directly as Array
     * @param bool $ignoreEnableFields Ignores Hidden, Startdate, enddate but NOT deleted!
     * @return array|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findByUserAllpages($user , $toArray=TRUE , $ignoreEnableFields = TRUE )
    {
        $query = $this->createQuery();
        $querySettings = $query->getQuerySettings() ;
        $querySettings->setRespectStoragePage(false);
        $querySettings->setRespectSysLanguage(FALSE);
        $querySettings->setIgnoreEnableFields($ignoreEnableFields) ;
        $query->setQuerySettings($querySettings) ;

        // $query->setLimit($limit) ;
        $constraints[] = $query->like('access_users', "%," . $user ) ;
        $constraints[] = $query->like('access_users',  $user .",%") ;
        $constraints[] = $query->equals('access_users',  $user ) ;

        if ( $ignoreEnableFields ) {
            $constraints2[] = $query->logicalOr(...$constraints);
            $constraints2[] = $query->equals('deleted',  0 );

            $query->matching( $query->logicalAnd(...$constraints2) ;
        } else {
            $query->matching( $query->logicalOr(...$constraints) ) ;
        }

        $res = $query->execute() ;
        // $this->debugQuery($query) ;

        if( $toArray === TRUE ) {
            return $res->toArray();
        } else {
            return $res ;
        }
    }

    /**
     * @param array|bool $filter possible Filters
     * @param bool $toArray Result as QueryInterface or directly as Array
     * @param bool $ignoreEnableFields Ignores Hidden, Startdate, enddate but NOT deleted!
     * @param bool|int $limit max number of organizers
     * @param bool $reverseSorting sort descending. needed for tango mode
     * @return array|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findByFilterAllpages($filter=FALSE , bool $toArray=FALSE , bool $ignoreEnableFields = FALSE , $limit=FALSE , $reverseSorting=false )
    {
        $query = $this->createQuery();
        if( $reverseSorting ) {
            $fields = [ "organizer_category" , 'sorting' , 'tstamp'];
            $number = rand(0, 1);

            // if one of last 3 options, always lowest values first
            $sorting = ($number > 0 ) ? 1 : rand(0, 1);
            if ($sorting > 0) {
                // if field sorting or tspamt is used, always  descending
                $query->setOrderings([ $fields[$number] => QueryInterface::ORDER_DESCENDING]);
            } else {

                $query->setOrderings([ $fields[$number] => QueryInterface::ORDER_ASCENDING]);
            }

        } else {
            $query->setOrderings($this->defaultOrderings);
        }


        $querySettings = $query->getQuerySettings() ;
        $querySettings->setRespectStoragePage(false);
        $querySettings->setRespectSysLanguage(FALSE);
        $querySettings->setIgnoreEnableFields($ignoreEnableFields) ;
        $query->setQuerySettings($querySettings) ;
        $constraints = array() ;
        if ( $filter ) {
            foreach ( $filter as $field => $value) {
                switch ($field) {
                    case "tstamp":
                    case "latest_event":
                        $constraints[] = $query->greaterThanOrEqual($field ,  $value ) ;
                        break;
                    default:
                        if( is_array( $value ) ) {
                            $constraints[] = $query->in($field ,  $value ) ;
                        } else {
                            $constraints[] = $query->equals($field, $value);
                        }
                        break;

                }
            }
        }
        // and the normal visibility contrains , including date Time


        if( $limit) {
            $query->setLimit(intval($limit));
        }

        if ( $ignoreEnableFields ) {
            $constraints[] =  $query->equals('deleted',  0 )  ;

        }
        if( count($constraints) > 0) {
            if( count($constraints) > 1) {
                $query->matching( $query->logicalAnd(...$constraints)) ;
            } else {

                $query->matching( reset($constraints) ) ;
            }
        }

        $res = $query->execute() ;
        //  $this->debugQuery($query) ;

        if( $toArray === TRUE ) {
            return $res->toArray();
        } else {
            return $res ;
        }
    }

    /**
     * @param integer $sorting
     * @return QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findBySortingAllpages($sorting  )
    {
        $query = $this->createQuery();
        $query->setOrderings($this->defaultOrderings);

        $querySettings = $query->getQuerySettings() ;
        $querySettings->setRespectStoragePage(false);
        $querySettings->setRespectSysLanguage(FALSE);
        $query->setQuerySettings($querySettings) ;
        $constraint = $query->lessThanOrEqual("sorting" ,  $sorting ) ;

        $query->matching( $constraint) ;

        $res = $query->execute() ;
        // $this->debugQuery($query) ;
        return $res ;
    }



}