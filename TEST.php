<?php




    public function hookShoppingCart()
    {
        $this->_clearCache('cross.tpl');
        //$reference = Configuration::get('ADVANCEDCROSSSELLING_DISPLAY_PRODUCTS');
       
    
            $result=array();
            $array_image = array();

            /* current cart products */
            $products = Context::getContext()->cart->getProducts();                   
            $product_category = array();
            foreach ($products as $product) 
            $product_category[] = (int)$product['id_category_default'];

           // echo "<pre>";
            //print_r($product_category);
            //die();

            $sql ="SELECT p.id_product, p.id_category_default, p.price,p.reference,pl.description_short,pl.name 
                     FROM "._DB_PREFIX_."product AS p 
                     LEFT JOIN "._DB_PREFIX_."product_lang AS pl ON p.id_product = pl.id_product 
                     WHERE p.id_category_default IN (";
              for ($i=0;$i<count($product_category);$i++)
                $sql.="'".$product_category[$i]."',";              
                $sql=substr($sql,0,-1);
                $sql.= ") AND p.reference NOT IN ('demo_3')";
                $sql.= ") GROUP BY p.id_product";
                $result = Db::getInstance()->ExecuteS($sql); 

                //print_r($result);
                //die();


                global $link;

                for ($i=0;$i<count($result);$i++  ) {
                        $id_image = Product::getCover($result[$i]["id_product"]);
                        // get Image by id
                        if (sizeof($id_image) > 0) {
                            $image = new Image($id_image['id_image']);
                            // get image full URL
                            $image_url = _PS_BASE_URL_._THEME_PROD_DIR_.$image->getExistingImgPath().".jpg";
                        
                            $result[$i]['url_image'] =$image_url;
                            
                            // get product link
                            $link_p = $link->getProductLink($result[$i]["id_product"]);
                            $result[$i]['url_product'] =$link_p;

                         }
                

                  }


                 // print_r($result);
                  //die();
                  $this->context->smarty->assign('results',$result);
                  return $this->display(__FILE__,'views/cross.tpl');
        


    }