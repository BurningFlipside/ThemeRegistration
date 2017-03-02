<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('class.ThemePage.php');
require_once('class.ThemeDB.php');
$page = new ThemePage('Burning Flipside - Registration');

$page->addWellKnownJS(JS_DATATABLE, false);
$page->addWellKnownCSS(CSS_DATATABLE);
$page->addJSByURI('js/view.js');

$page->body .= '
<div id="content">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="themeHeader">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#tc" aria-expanded="true" aria-controls="tc">Themes</a>
                </h4>
            </div>
            <div id="tc" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="themeHeader">
                <div class="panel-body">
                    <table class="table" id="themeTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Presenting</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </idv>
        </div>
</div>';

$page->printPage();
?>
