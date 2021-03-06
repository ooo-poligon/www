<?php

/*
 * Скрипт создаёт/обновляет в базе данных таблицу efind.
 * К этой таблице обращается скрипт поиска данных для выдачи их на efind-е
 */

    $host = 'localhost';      
    $user = 'poliinfo_bitrix';
    $pass = 'Y2Gd75q';
    $base = 'poliinfo_bitrix';
    
    $imageUrlPref = 'http://poligon.info/images/';
    $pdfUrlPref = 'http://poligon.info/PDF/';
    $poliUrlPref = 'http://www.poligon.info/catalog/index.php?ELEMENT_ID=';


    // Соединение с базой данных
    if($lnk = mysql_connect($host, $user, $pass)){
        // Установка текущей базы данных
        mysql_select_db($base, $lnk);
        
        // Удаляем старую таблицу..
        mysql_query("DROP TABLE `efind`");
        
        // Создаём новую...
        mysql_query("CREATE TABLE `efind` (
                          `ID` int(11) NOT NULL, 
                          `NAME_ORDERCODE` varchar(255) NOT NULL,
                          `DESC` text,
                          `MNFR` varchar(255) default NULL,
                          `STOCK` varchar(255) default NULL,
                          `STOCK_DELIVERY` varchar(255) default NULL,
                          `PICTURE_LINK` varchar(255) default NULL,
                          `PDF_LINK` varchar(255) default NULL,
                          `POLI_LINK` varchar(255) default NULL,
                          `CURRENCY` varchar(3) default NULL,
                          `PRICE1` decimal(10,2) default NULL,
                          `PRICE2` decimal(10,2) default NULL,
                          `PRICE3` decimal(10,2) default NULL,
                          `SEARCH_CONTENT` text,
                          PRIMARY KEY (`ID`),
                          KEY `NAME_ORDERCODE` (`NAME_ORDERCODE`)) ENGINE=MyISAM DEFAULT CHARSET=cp1251", $lnk);
        
        // Импортируем данные из битриксовских таблиц
       mysql_query("INSERT IGNORE INTO efind
                    SELECT
                        bsc.id,
                        IF(biep_artnum.value IS NULL, bsc.title, CONCAT(bsc.title, ' (', biep_artnum.value, ')')),
                        bie.preview_text,
                        biep_mfg.value,
                        IF(bcprod.quantity = '0' AND biep_deliv.value IS NOT NULL, biep_deliv.value, bcprod.quantity),
                        bcprod.quantity,
                        CONCAT('$imageUrlPref', biep_img.value),
                        CONCAT('$pdfUrlPref', biep_pdf.value),
                        CONCAT('$poliUrlPref', bsc.item_id),
                        bcp.currency,
                        bcp.price,
                        null,
                        null,
                        bsc.searchable_content
                    FROM 
                        b_search_content bsc
                        LEFT JOIN b_iblock_element AS bie ON (bie.id = bsc.item_id)
                        LEFT JOIN b_iblock_element_property AS biep_artnum ON (biep_artnum.iblock_element_id = bsc.item_id AND biep_artnum.iblock_property_id = '16')
                        LEFT JOIN b_iblock_element_property AS biep_mfg ON (biep_mfg.iblock_element_id = bsc.item_id AND biep_mfg.iblock_property_id = '20')
                        LEFT JOIN b_iblock_element_property AS biep_img ON (biep_img.iblock_element_id = bsc.item_id AND biep_img.iblock_property_id = '18')
                        LEFT JOIN b_iblock_element_property AS biep_pdf ON (biep_pdf.iblock_element_id = bsc.item_id AND biep_pdf.iblock_property_id = '19')
                        LEFT JOIN b_iblock_element_property AS biep_deliv ON (biep_deliv.iblock_element_id = bsc.item_id AND biep_deliv.iblock_property_id = '24')
                        LEFT JOIN b_catalog_price AS bcp ON (bcp.product_id = bsc.item_id AND bcp.quantity_from = '1')
                        LEFT JOIN b_catalog_product AS bcprod ON (bcprod.id = bsc.item_id)
                    WHERE
                        bsc.module_id = 'iblock'
                        AND param1 = 'catalog'
                        AND param2 = 4
                    ORDER BY
                        bcp.timestamp_x DESC", $lnk);
                            
        echo mysql_affected_rows() . " rows added in efind table.\n";
        
        mysql_close($lnk);
    }else{
        header("HTTP/1.1 500 Internal Server Error");
        print "<h1>500 Internal Server Error</h1>" . "Could not connecto to database";
        exit;
    }
?> 
