<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Runquery extends CI_Controller
{
    public function index()
    // {
    // }
    // public function product_info_insert()
    // {
    //     echo '<pre>';
    //     $data = getAllData('catalog/products');
    //     $product = json_decode($data, true);
    //     if (!empty($product['data'])) {
    //         foreach ($product['data'] as $pro) {
    //             $this->CommonModal->insertRowReturnId('bc_product', array('id' => $pro['id'], 'b_id' => $pro['id'], 'name' => $pro['name'], 'type' => $pro['type'], 'sku' => $pro['sku'], 'description' => $pro['description'], 'weight' => $pro['weight'], 'price' => $pro['price'], 'calculated_price' => $pro['calculated_price'], 'categories' => json_encode($pro['categories']), 'is_visible' => $pro['is_visible'], 'is_featured' => $pro['is_featured']));
    //             // images
    //             $images = getAllData('catalog/products/' . $pro['id'] . '/images');
    //             $img = json_decode($images, true);
    //             if ($img != '') {
    //                 foreach ($img['data'] as $single_img) {
    //                     $this->CommonModal->insertRowReturnId('bc_product_images', array('id' => $single_img['id'], 'product_id' => $single_img['product_id'], 'is_thumbnail' => $single_img['is_thumbnail'], 'image_file' => $single_img['image_file'], 'url_zoom' => $single_img['url_zoom'], 'url_standard' => $single_img['url_standard'], 'url_thumbnail' => $single_img['url_thumbnail'], 'url_tiny' => $single_img['url_tiny'], 'date_modified' => $single_img['date_modified']));
    //                 }
    //             }
    //             // review
    //             $review = getAllData('catalog/products/' . $pro['id'] . '/reviews');
    //             $product_review = json_decode($review, true);

    //             foreach ($product_review['data'] as $rev) {
    //                 $this->CommonModal->insertRowReturnId('bc_product_review', array('id' => $rev['id'], 'title' => $rev['title'], 'text' => $rev['text'], 'status' => $rev['status'], 'rating' => $rev['rating'], 'email' => $rev['email'], 'name' => $rev['name'], 'date_reviewed' => $rev['date_reviewed'], 'product_id' => $rev['product_id'], 'date_created' => $rev['date_created'], 'date_modified' => $rev['date_modified']));
    //             }


    //             // variants
    //             $variant = getAllData('catalog/products/' . $pro['id'] . '/variants');
    //             $product_variant = json_decode($variant, true);
    //             if (count($product_variant['data']) > 1) {

    //                 foreach ($product_variant['data'] as $variant_row) {
    //                     $this->CommonModal->insertRowReturnId('bc_product_variants', array('id' => $variant_row['id'], 'product_id' => $variant_row['product_id'], 'sku' => $variant_row['sku'], 'sku_id' => $variant_row['sku_id'], 'price' => $variant_row['price'], 'sale_price' => $variant_row['sale_price'], 'calculated_weight' => $variant_row['calculated_weight'], 'is_free_shipping' => $variant_row['is_free_shipping'], 'image_url' => $variant_row['image_url'], 'option_values' => json_encode($variant_row['option_values'])));
    //                 }
    //             }
    //             // break;
    //         }
    //     }
    // }
    // public function categoryinsert()
    {
        $subcat = getAllData('catalog/categories/tree');
        $category = json_decode($subcat, true);
        foreach ($category['data'] as $cat) {
            $category_data = json_decode(
                getAllData('catalog/categories/' . $cat['id']),
                true
            );
            $this->CommonModal->insertRowReturnId('bc_category', array('id' => $category_data['data']['id'], 'parent_id' => $category_data['data']['parent_id'], 'name' => $category_data['data']['name'], 'description' => $category_data['data']['description'], 'image_url' => $category_data['data']['image_url'], 'is_visible' => $category_data['data']['is_visible']));
            if (count($cat['children']) > 0) {
                foreach ($cat['children'] as $subcat) {
                    $sub_category = json_decode(
                        getAllData('catalog/categories/' . $subcat['id']),
                        true
                    );

                    $this->CommonModal->insertRowReturnId('bc_category', array('id' => $sub_category['data']['id'], 'parent_id' => $sub_category['data']['parent_id'], 'name' => $sub_category['data']['name'], 'description' => $sub_category['data']['description'], 'image_url' => $sub_category['data']['image_url'], 'is_visible' => $sub_category['data']['is_visible']));
                }
            }
        }
    }
}
