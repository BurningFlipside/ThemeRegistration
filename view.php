<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('class.ThemePage.php');
require_once('class.ThemeDB.php');
$page = new ThemePage('Burning Flipside - Registration');

$page->addCSS('//unpkg.com/tabulator-tables@6.2.1/dist/css/tabulator.min.css');
$page->addJS('//unpkg.com/tabulator-tables@6.2.1/dist/js/tabulator.min.js');

$page->body .= '
<div id="content">
        <div class="card">
            <div class="card-header" role="tab" id="themeHeader">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#tc" aria-expanded="true" aria-controls="tc">Themes</a>
                </h4>
            </div>
            <div id="tc" class="collapse show" role="tabpanel" aria-labelledby="themeHeader">
                <div class="card-body">
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
