<?php
namespace JVE\JvEvents\Domain\Repository;

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
class OrganizerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
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
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
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
            $query->matching( $query->logicalAnd(
                array( $query->logicalOr($constraints)  , $query->equals('deleted',  0 )  )
            ) ) ;
        } else {
            $query->matching( $query->logicalOr($constraints) ) ;
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
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findByFilterAllpages($filter=FALSE , $toArray=FALSE , $ignoreEnableFields = FALSE , $limit=FALSE)
    {
        $query = $this->createQuery();
        $query->setOrderings($this->defaultOrderings);

        $querySettings = $query->getQuerySettings() ;
        $querySettings->setRespectStoragePage(false);
        $querySettings->setRespectSysLanguage(FALSE);
        $querySettings->setIgnoreEnableFields($ignoreEnableFields) ;
        $query->setQuerySettings($querySettings) ;
        $constraints = array() ;
        if ( $filter ) {
            foreach ( $filter as $field => $value) {
                $constraints[] = $query->equals($field ,  $value ) ;
            }
        }

        // and the normal visibility contrains , including date Time
        /** @var \DateTime $actualTime */
        $actualTime = new \DateTime('now' ) ;
        $actualTime->modify('-3 YEAR') ;
        $constraints[] = $query->greaterThanOrEqual('tstamp', $actualTime );


        if( $limit) {
            $query->setLimit(intval($limit));
        }

        if ( $ignoreEnableFields ) {
            $constraints[] =  $query->equals('deleted',  0 )  ;
        }
        if( count($constraints) > 0) {
            $query->matching( $query->logicalAnd($constraints)) ;
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
     * @param integer $sorting
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
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


    function debugQuery($query) {
        // new way to debug typo3 db queries
        $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
        $querystr = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL() ;
        echo $querystr ;
        echo "<hr>" ;
        $queryParams = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters() ;
        var_dump($queryParams);
        echo "<hr>" ;

        foreach ($queryParams as $key => $value ) {
            $search[] = ":" . $key ;
            $replace[] = "'$value'" ;

        }
        echo str_replace( $search , $replace , $querystr ) ;

        die;
    }
}