<?php

namespace JVelletti\JvEvents\ViewHelpers\Be;


use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Http\Uri;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class LinkViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

    /**
     * @var string
     */
    protected $tagName = 'a';
    /**
     * Initialize arguments
     *
     * @return void
     * @api
     */
    public function initializeArguments() {
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
        $this->registerTagAttribute('uid', 'integer', 'Uid of the data record' , true );
        $this->registerTagAttribute('pageId', 'integer', 'page Uid where to go ' , true );
        $this->registerTagAttribute('onlyActual', 'integer', 'actually default : Date -90 Days if checked'  , true );
        $this->registerTagAttribute('eventId', 'integer', 'id of the event if set ' , false );
        $this->registerTagAttribute('recursive', 'integer', 'if checkbox is set to search recursive ' , false );
        $this->registerTagAttribute('table', 'string', 'Name of the database table' , false , "tx_jvevents_domain_model_event" );
        $this->registerTagAttribute('returnM', 'string', 'Module name_of_backend' , false , "jvevents_eventmngt");
        $this->registerTagAttribute('returnPid', 'string', 'Current Pid' , false , "0");
        $this->registerTagAttribute('returnModule', 'string', 'parameterArray' , false , "tx_jvevents_web_jveventseventmngt");
        $this->registerTagAttribute('returnController', 'string', 'controller name_of_backend' , false , "");
        $this->registerTagAttribute('returnAction', 'string', 'function name of the action' , true , "list");
    }

    /**
     *
     * Renders a link to go back to edit a specific Data entry
     *
     * @return string   return the <a> tag
     *
     */

    public function render( ) {
        $uid        = ( $this->arguments['uid'] ?? 0 );
        $table   = ($this->arguments['table'] ?? '' ) ;
        $returnM   = ($this->arguments['returnM'] ?? '' ) ;

        $returnModule  = ($this->arguments['returnModule'] ?? '' ) ;
        $returnController   = ($this->arguments['returnController'] ?? '' ) ;
        $returnAction   = ($this->arguments['returnAction'] ?? '' ) ;
        $returnPid   = ($this->arguments['pageId'] ?? '' ) ;
        $eventId   = ($this->arguments['eventId'] ?? '' ) ;
        $recursive   = ($this->arguments['recursive'] ?? '' ) ;
        $onlyActual  = ($this->arguments['onlyActual'] ?? '' ) ;
        $class   = ($this->arguments['class'] ?? '' ) ;


        $returnUrl = '' ;
        if( $this->arguments['returnPid'] > 0 ) {
            $returnArray = [
               'action' => $returnAction,
               'recursive' => $recursive,
               'event' => $eventId,
               'onlyActual' => $onlyActual
            ];
            $returnArray['id'] = $this->arguments['returnPid'] ;
            //  Routing in LTS 9 is without /module, but / at the end    | LTS 10 "/module" at beginning, but no / at the end
            $moduleName = str_replace( array( "module/" , "/" ) , array("" ,"_" ), trim( $returnM , "/") ) ;
            $debug[] = $returnM ;
            $debug[] = $moduleName ;

            try {
                /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
                $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);

                $returnUrlObj = $uriBuilder->buildUriFromRoute($moduleName,  $returnArray );
                $returnUrl = $returnUrlObj->getPath() . "?" .  $returnUrlObj->getQuery() ;
            } catch (\TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException $e) {
                $returnUrl = "exceptionInRoute__" . $moduleName ;
            }
        }

        $debug[] = $returnUrl ;

        try {
            /** @var \TYPO3\CMS\Backend\Routing\UriBuilder $uriBuilder */
            $uriBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Routing\UriBuilder::class);

            $uri = $uriBuilder->buildUriFromRoute('record_edit', array( 'edit['. $table . '][' . $uid . ']' => 'edit' ,'returnUrl' => $returnUrl )) ;
        } catch (\TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException $e) {
            // no route registered, use the fallback logic to check for a module
            $uri = "exceptionInRoute__record_edit"  ;
        }

        $this->tag->setTagName("a") ;

        $this->tag->addAttribute('href', $uri  );
        $this->tag->addAttribute('class', $class  );
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(TRUE);
        return $this->tag->render();

    }

}