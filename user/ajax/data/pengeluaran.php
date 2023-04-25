<?php
    session_start();
    require '../../../database_connect.php';

    $id_user = $_SESSION['user_id'];

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'null',
        1 => 'tanggal',
        2 => 'keterangan',
        3 => 'keperluan_untuk',
        4 => 'jumlah',
        5 => 'null'
    );

    $sql = "SELECT * FROM pengeluaran WHERE id_user='$id_user'";

    $query = mysqli_query($con, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = "SELECT * FROM pengeluaran WHERE id_user='$id_user' AND 1=1";

    if( !empty($requestData['search']['value']) ) 
    {
        $sql.=" AND  pd.keterangan LIKE '%".$requestData['search']['value']."%' ";
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
        $nestedData[] = date("d-m-Y", strtotime($row->tanggal));
        $nestedData[] = $row->keterangan;
        $nestedData[] = $row->keperluan_untuk;
        $nestedData[] = "Rp. ".number_format($row->jumlah, 0,'.','.');
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