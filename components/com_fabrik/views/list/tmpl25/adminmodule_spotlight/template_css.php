<?php
header('Content-type: text/css');
$c = $_REQUEST['c'];
echo "
#listform_$c table.fabrikList {
	border-collapse: collapse;
	margin-top: 10px;
	color: #444444;
	/* seem to remember an issue with this,
	but it seems nicer to have the table full width
	- then you can right align the top buttons against it */
	width:100%;
}
#listform_$c .fabrik_buttons{
height:2.5em;
	text-align:right;
}

#listform_$c a,
#listform_$c .fabrikDataContainer  a:hover{
	border:0;
	background:transparent;
}

#listform_$c .list-footer{
	display:-moz-box;
	display:-webkit-box;
	display:box;
}

#listform_$c .list-footer div{
	margin-top:8px;
	margin-left:10px;
}

#listform_$c .list-footer .pagination{
	margin-left:20px;
}


#listform_$c .fabrik_ordercell a{
	text-decoration:none;
	color:#333;
}

#listform_$c .fabrik_ordercell a:hover{
	color:#333;
}

#listform_$c .fabrikElementContainer{
	/** for inline edit **/
	position:relative;
}

#listform_$c table.fabrikList,
.advancedSeach_$c table {
	border-collapse: collapse;
	margin-top: 10px;
}

#listform_$c table.fabrikList td,table.fabrikList th,
.advancedSeach_$c td, .advancedSeach_$c th {
	padding: 5px;
	border-bottom: 2px solid #e6e8e9;
	vertical-align:top;
}

/** bump calendar above mocha window in mootools 1.2**/
div.calendar{
	z-index:115 !important;
}

/** autocomplete container inject in doc body not iin #forn_$c */
.auto-complete-container{
	overflow-y: hidden;
	border:1px solid #ddd;
}

.auto-complete-container ul{
	list-style:none;
	background-color:#fff;
	margin:0;
	padding:0;
}

.auto-complete-container li{
	text-align:left;
	padding:2px 10px !important;
	background:#fff;
	margin:0 !important;
	border-top:1px solid #ddd;
	cursor:hand;
}

.auto-complete-container li:hover,
.auto-complete-container li.selected{
	background-color:#DFFAFF !important;
	cursor:pointer;
}

#listform_$c .fabrikForm {
	margin-top: 15px;
}

#listform_$c .fabrik_groupheading,
#listform_$c .fabrik___heading{
	background-color: #1a80b2;
	-moz-user-select: none;
	color: #fff;
	font-weight: bold;
	min-height: 20px;
	line-height: 19px;
	margin: 0;
	text-align: left;
	text-transform: uppercase;
}

#listform_$c .fabrikNav{
	border-top: 1px solid #333;
}

#listform_$c .fabrik_groupheading a{
	color: #777777;
	text-decoration:none;
}

#listform_$c table.fabrikList tr.fabrik_calculations td {
	border: 0 !important;
}

#listform_$c .oddRow0 {
	background-color: #ffffff;
}

#listform_$c .oddRow1,
.advancedSeach_$c .oddRow1 {
	background-color: #f3f9fb;
}


#listform_$c table.fabrikList tr.fabrik_calculations td {
	border: 0 !important;
}

#listform_$c .firstPage,.previousPage,.aPage,.nextPage,.lastPage {
	display: inline;
	padding: 3px;
}

#listform_$c table.filtertable {
	width: 50%;
}

#listform_$c .fabrikHover {
	background-color: #ffffff;
}

/** highlight the last row that was clicked */
#listform_$c .fabrikRowClick {
	background-color: #ffffff;
}

/** highlight the loaded row - package only */
#listform_$c .activeRow {
	background-color: #FFFFCC;
}

#listform_$c .emptyDataMessage {
	background-color: #EFE7B8;
	border-color: #EFD859;
	border-width: 2px 0;
	border-style: solid;
	padding: 5px;
	margin: 10px 0;
	font-size: 1em;
	color: #CC0000;
	font-weight: bold;
}

#listform_$c .fabrikButtons {
	text-align: right;
	padding-top: 10px;
}

#listform_$c ul.fabrikRepeatData {
	padding: 0;
	margin: 0;
	list-style: none;
}

#listform_$c ul.fabrikRepeatData li {
	background-image: none;
	padding: 0;
	margin: 0;
}
/*****************************************************/
/********** default action formatting ****************/
/*****************************************************/

#listform_$c .fabrik_row ul.fabrik_action,
#listform_$c ul.fabrik_action,
.advancedSeach_$c ul.fabrik_action{
	list-style:none !important;
	border:1px solid #999;
	padding:0;
	text-align:left;
	font-weight: bold;
	font-size: 11px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius: 6px;
	height:23px;
	margin:5px;
	filter: progid : DXImageTransform.Microsoft.gradient ( startColorstr =
		'#cccccc', endColorstr = '#666666' ); /* for IE */
	background: -webkit-gradient(linear, left top, left bottom, from(#eee),
		to(#ccc) ); /* for webkit browsers */
	background: -moz-linear-gradient(top, #eee, #ccc);
	display:-moz-box;
	/* chrome: causes images in menu not to be displayed
	display:-webkit-box;*/
	display:box;
	float:right;
}

#listform_$c .fabrik_row ul.fabrik_action span,
#listform_$c ul.fabrik_action span{
	display:none;
}

#listform_$c ul.fabrik_action.fabrik_keeptext span{
	display:inline;
}

#listform_$c .fabrik_row .fabrik_action li,
#listform_$c .fabrik_action li,
.advancedSeach_$c .fabrik_action li{
	float:left;
	padding:2px 6px 0 6px;
	border-left:1px solid #999;
	min-height:17px;
	margin-top:2px;
	margin-bottom:2px;


}

#listform_$c .fabrik_row .fabrik_action li:first-child,
#listform_$c .fabrik_action li:first-child,
.advancedSeach_$c .fabrik_action li:first-child{
-moz-border-radius: 6px 0 0 6px;
	-webkit-border-radius: 6px 0 0 6px;
	border-radius: 6px 0 0 6px;
	border:0;
}

#listform_$c .fabrik_row .fabrik_action li:last-child,
#listform_$c .fabrik_action li:last-child,
.advancedSeach_$c .fabrik_action li:last-child{
-moz-border-radius: 0 6px 6px 0;
	-webkit-border-radius: 0 6px 6px 0;
	border-radius: 0 6px 6px 0;
}

.podionTip{
border-radius:5px;
border:1px solid #b5b5b5;
background-color:#fff;
padding:9px;
}

.podionTip-triangle{

}
";?>