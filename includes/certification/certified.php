<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>QMS</td>
    <td>EMS</td>
    <td>FSM</td>
    <!--<td>HACCP</td> -->
    <td>OSHAS</td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td><div style="display:inline; float:left">Select certification shceme&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div style="display:inline; float:right">
      <form name="form1" id="form1">
        <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
          <option value="default.php?view=qms_firms">Quality Management System</option>
          <option>Environmental Management System</option>
          <option value="default.php?view=ems_certfirms" selected="selected">FSMS</option>
          <!-- <option>HACCP</option> -->
          <option>OSHAS</option>
                                                </select>
      </form></div></td>
  </tr>
  <tr>
    <td><?php
	
	include_once('certified_firms.php');
	//require_once $cetified_firms;
	
	?></td>
  </tr>
</table>
