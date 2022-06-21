<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Print Users - Dashbord</title>


</head>

<body>
<br>
<br>
<div class="container" style="border: 1px solid black;">
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table width="90%" border="0">
                <tr>
                    <th width="48%" ><div align="center">REPUBLIQUE DU CAMEROUN</div></th>
                    <th width="13%" rowspan="8" scope="col">
                        <img src="img/nation.png"width="100" height="100" />
                    </th>
                    </th>
                    <th width="48%" ><div align="center">REPUBLIC OF CAMEROON</div></th>
                </tr>
                <tr>
                    <th scope="row" class="Style9"><div align="center">Paix-Travail-Patrie</div></th>
                    <th scope="row" class="Style9"><div align="center">Peace-Work-Fatherland</div></th>
                </tr>
            </table>
            <br>
            <div class="col-md-10 offset-1">
                <br>
                <br>
                <h2 align="center" class="Style4"><span class="Style8">Liste des utilisateurs </span></h2>
                <br>
                <br>

                <table width="100%" border="1"  cellspacing="0" >
                    <tr>
                        <th>Id</th>
                        <th>date_livraison</th>
                        <th>type_carburant</th>
                        <th>quantiteLivree</th>
                        <th>compagnie</th>

                    </tr>
                    @php $i = 1; @endphp
                    @foreach($citernes as $citerne)
                        <tr>
                            <td> @php echo $i++;  @endphp </td>
                            <td>{{$citerne->date_livraison}}</td>
                            <td>{{$citerne->type_carburant}}</td>
                            <td>{{$citerne->quantiteLivree}}</td>
                            <td>{{$citerne->compagnie}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <br>
            <br>
            <br>
            <div class="col-md-10 offset-1">
                <table width="40%" border="0" align="right">
                    <tr align="left">
                        <th  scope="col"><div align="left"><span class="Style1">Fait par: {{Auth::user()->nom}}&nbsp;{{Auth::user()->prenom}}  le:  {{NOW()->format('d/m/Y')}} </span></div></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

</body>
</html>
