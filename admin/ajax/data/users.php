<?php

    require '../../../database_connect.php';

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'null',
        1 => 'nama',
        2 => 'jenis_kelamin',
        3 => 'username',
        4 => 'pass',
        5 => 'status_account',
        6 => 'role_name',
        7 => 'null'
    );

    $sql = "SELECT
    u.id,
    pd.nama,
    pd.jenis_kelamin,
    u.username,
    u.pass,
    u.status_account,
    r.role_name
    FROM users u
    JOIN personal_data pd ON u.personal_id = pd.id
    JOIN roles r ON u.role_id = r.role_id";

    $query = mysqli_query($con, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = "SELECT
    u.id,
    pd.nama,
    pd.jenis_kelamin,
    u.username,
    u.pass,
    u.status_account,
    r.role_name
    FROM users u
    JOIN personal_data pd ON u.personal_id = pd.id
    JOIN roles r ON u.role_id = r.role_id";

    if( !empty($requestData['search']['value']) ) 
    {
        $sql.=" AND  pd.nama LIKE '%".$requestData['search']['value']."%' ";
    }

    $query=mysqli_query($con, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";	
    $query=mysqli_query($con, $sql);

    $data = array();
    while($row = mysqli_fetch_object($query))
    {
        $nestedData = array();
        $nestedData[] = "";
        $nestedData[] = $row->nama;
        $nestedData[] = $row->jenis_kelamin;
        $nestedData[] = $row->username;
        $nestedData[] = $row->pass;
        $nestedData[] = ($row->status_account == "y" ? "<span class='fas fa-check-circle text-success'></span>" : "<span class='fas fa-times-circle text-danger'></span>");
        $nestedData[] = $row->role_name;
        $nestedData[] = "<button type='button' class='btn btn-info btn-sm update mb-3' data-id='{$row->id}'><em class='fas fa-edit text-white'></em></button> <button type='button' class='btn btn-danger btn-sm delete mb-3' data-id='{$row->id}'><em class='fas fa-trash text-white'></em></button>";
        $data[] = $nestedData;
    }

    $json_data = array(
        "draw"            => intval( $requestData['draw'] ),  
        "recordsTotal"    => intval( $totalData ), 
        "recordsFiltered" => intval( $totalFiltered ), 
        "data"            => $data 
    );

    echo json_encode($json_data);

    sleep(3);

?>