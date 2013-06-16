<html>
<head>
    <script type="text/javascript">
                function sendup(X) {
                    var RowIndex = X.parentNode.rowIndex;
                    var ParentTable = X.parentNode.parentElement;
                    if (RowIndex != 0 && RowIndex != 1) {
                        ParentTable.moveRow(RowIndex, RowIndex - 1);
                    }
                }
                
                function mv(ele){
                  
                }
    </script>
</head>

<body>
    
    <?php 
        $conn = mysql_connect('localhost','root','')or
		die ("error");
        mysql_select_db('mydb') or 
                die ("error");
    ?>
    <?php $route =1 ;?>
    <table  cellpadding="0" cellspacing="0" >
   <tr>
        <th>Halt</th>
        <th>up</th>
        <th>down</th>
        <th>delete</th>
    </tr>
    <?php
        $gethalts = mysql_query("SELECT h.name FROM route_halt as rh, halt as h WHERE h.halt_id =rh.halt_id AND rh.route_id=".$route." ORDER BY rh.order");
        while ($res = mysql_fetch_array($gethalts)){
    ?>
    
    <tr>
        <td> <?php echo $res['name'] ?> </td>
   	<td> <input id="bnUp" type="button" value="UP" name="bnUp" onclick='Javascript:sendup(this)'/> </td>
        <td><img src="../img/down.png" title="down" /></td>
        <td><img src="../img/delete.png" title="delete" /></td>
                                
    </tr>
    <?php } ?>
    
   </table>
</body>
</html>
