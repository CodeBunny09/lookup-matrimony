<?php

include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

if (isset($_POST['saved_nm'])) {
    if (isset($_POST['saved_nm'])) {
        $ss_name = $_POST['saved_nm'];
    } else {
        $ss_name = '';
    }
    if (isset($_SESSION['fromage'])) {
        $fromage = $_SESSION['fromage'];
    } else {
        $fromage = '';
    }
    if (isset($_SESSION['toage'])) {
        $toage = $_SESSION['toage'];
    } else {
        $toage = '';
    }
    if (isset($_SESSION['fromheight'])) {
        $from_height = $_SESSION['fromheight'];
    } else {
        $from_height = '';
    }
    if (isset($_SESSION['toheight'])) {
        $to_height = $_SESSION['toheight'];
    } else {
        $to_height = '';
    }
    if (isset($_SESSION['m_status'])) {
        $m_status = str_replace("','", ",", $_SESSION['m_status']);
    } else {
        $m_status = '';
    }
    if (isset($_SESSION['tot_children'])) {
        $tot_children = $_SESSION['tot_children'];
    } else {
        $tot_children = '';
    }

    if (isset($_SESSION['religion'])) {
        $religion_id = $_SESSION['religion'];
    } else {
        $religion_id = '';
    }
    if (isset($_SESSION['caste'])) {
        $caste_id = $_SESSION['caste'];
    } else {
        $caste_id = '';
    }
    if (isset($_SESSION['m_tongue'])) {
        $m_tongue = $_SESSION['m_tongue'];
    } else {
        $m_tongue = '';
    }
    if (isset($_SESSION['country'])) {
        $country_id = $_SESSION['country'];
    } else {
        $country_id = '';
    }
    if (isset($_SESSION['state'])) {
        $state_id = $_SESSION['state'];
    } else {
        $state_id = '';
    }
    if (isset($_SESSION['city'])) {
        $city_id = $_SESSION['city'];
    } else {
        $city_id = '';
    }
    if (isset($_SESSION['education'])) {
        $education = $_SESSION['education'];
    } else {
        $education = '';
    }
    if (isset($_SESSION['occupation'])) {
        $occupation = $_SESSION['occupation'];
    } else {
        $occupation = '';
    }

    if (isset($_SESSION['occupation'])) {
        $occupation = $_SESSION['occupation'];
    } else {
        $occupation = '';
    }

    if (isset($_SESSION['annual_income'])) {
        $annual_income = $_SESSION['annual_income'];
    } else {
        $annual_income = '';
    }

    if (isset($_SESSION['diet'])) {
        $diet = $_SESSION['diet'];
    } else {
        $diet = '';
    }
    if (isset($_SESSION['drink'])) {
        $drink = $_SESSION['drink'];
    } else {
        $drink = '';
    }
    if (isset($_SESSION['smoking'])) {
        $smoking = $_SESSION['smoking'];
    } else {
        $smoking = '';
    }
    if (isset($_SESSION['complexion'])) {
        $complexion = $_SESSION['complexion'];
    } else {
        $complexion = '';
    }
    if (isset($_SESSION['bodytype'])) {
        $bodytype = $_SESSION['bodytype'];
    } else {
        $bodytype = '';
    }
    if (isset($_SESSION['star'])) {
        $star = str_replace("','", ",", $_SESSION['star']);
    } else {
        $star = '';
    }
    if (isset($_SESSION['manglik'])) {
        $manglik = $_SESSION['manglik'];
    } else {
        $manglik = '';
    }

    if (isset($_SESSION['keyword'])) {
        $keyword = $_SESSION['keyword'];
    } else {
        $keyword = '';
    }

    if (isset($_SESSION['id_search'])) {
        $txt_id_search = $_SESSION['id_search'];
    } else {
        $txt_id_search = '';
    }

    if (isset($_SESSION['photo_search'])) {
        $photo_search = $_SESSION['photo_search'];
    } else {
        $photo_search = '';
    }


    $DatabaseCo->dbLink->query("insert into save_search (ss_name,matri_id,fromage,toage,from_height,to_height,marital_status,religion,caste,mother_tongue,country,state,city,education,with_photo,tot_children,occupation,annual_income,diet,drink,smoking,complexion,bodytype,star,manglik,keyword,id_search,save_date)values('" . $ss_name . "','" . $_SESSION['user_id'] . "','" . $fromage . "','" . $toage . "','" . $from_height . "','" . $to_height . "','" . $m_status . "','" . $religion_id . "','" . $caste_id . "','" . $m_tongue . "','" . $country_id . "','" . $state_id . "','" . $city_id . "','" . $education . "','" . $photo_search . "','" . $tot_children . "','" . $occupation . "','" . $annual_income . "','" . $diet . "','" . $drink . "','" . $smoking . "','" . $complexion . "','" . $bodytype . "','" . $star . "','" . $manglik . "','" . $keyword . "','" . $txt_id_search . "',NOW())");
}

echo "Your search preferences saved successfully.";
?>