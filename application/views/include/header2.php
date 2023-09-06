<header class="header4">
      <div id="header-sticky" class="header-main header-main4-2">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-12 col-lg-12">
                  <div class="header-main-content-wrapper">
                     <div class="header-main-left header-main-left-header4">
                        <div class="header-logo header4-logo">
                           <a href="index.html" class="logo-w"><img src="<?= base_url() ?>/assets/images/logo.png" alt="logo-img"></a>
                        </div>
                     </div>
                     <div class="header-main-right header-main-right-header4">
                        <div class="main-menu main-menu4 d-none d-lg-inline-block">
                           <nav id="mobile-menu2">
                              <ul>
                                 <li class="menu-item-has-childen"><a href="<?= base_url() ?>">Home</a></li>
                                  <li class="menu-item-has-childen"><a href="<?= base_url() ?>about">About</a>
                                    <ul class="sub-menu">
                                       <li><a href="services.html">Our Mission</a></li>
                                       <li><a href="service-details.html">Our vision</a></li>
                                       <li><a href="service-details.html">our Team</a></li>
                                       <li><a href="service-details.html">Our certification</a></li>
                                    </ul>
                                 </li>
                                 <li class="menu-item-has-childen"><a href="<?= base_url() ?>products">Products</a>
                                    <!-- <ul class="sub-menu">
                                       <li><a href="services.html">Services</a></li>
                                       <li><a href="service-details.html">Service Details</a></li>
                                    </ul> -->
                                 </li>
                                 <li class="menu-item-has-childrn"><a href="#">Blogs</a></li>
                                 <li class="menu-item-has-childrn"><a href="blog.html">My account</a>
                                    <ul class="sub-menu">
                                       <li><a href="blog.html">log in</a></li>
                                       <li><a href="blog-details.html">sign up</a></li>
                                    </ul>
                                 </li>
                                 <li><a href="<?= base_url() ?>contact">Contact</a></li>
                              </ul>
                           </nav>
                        </div>
                        <a href="<?= base_url() ?>cart" class="border-btn d-none d-xl-inline-flex"><i
                              class="fas fa-shopping-basket">  </i><span>Cart</span></a>
                        <div class="menu-bar d-lg-none">
                           <a class="side-toggle" href="javascript:void(0)">
                              <div class="bar-icon">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
   <div class="fix">
         <div class="side-info">
            <div class="side-info-content">
               <div class="offset-widget offset-logo mb-40">
                  <div class="row align-items-center">
                     <div class="col-9">
                        <a href="index.html">
                           <img src="assets/img/logo/logo-bl.png" alt="Logo">
                        </a>
                     </div>
                     <div class="col-3 text-end"><button class="side-info-close"><i class="fal fa-times"></i></button>
                     </div>
                  </div>
               </div>
               <div class="mobile-menu2 d-xl-none fix"></div>
               <div class="offset-widget offset_searchbar mb-30">
                  <form action="#" class="filter-search-input">
                     <input type="text" placeholder="Search keyword">
                     <button type="submit"><i class="fal fa-search"></i></button>
                  </form>
               </div>
               <div class="offset-widget offset-support mb-30">
                  <div class="footer-support">
                     <div class="irc-item support-meta">
                        <div class="irc-item-icon">
                           <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="irc-item-content">
                           <p>Emergency Call</p>
                           <div class="support-number"><a href="tel:<?= $this->contact['f_contact'] ?>"><?= $this->contact['f_contact'] ?></a></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="offset-widget offset-social mb-30">
                  <div class="footer-social">
                     <span>Connect:</span>
                     <div class="social-links">
                        <ul>
                           <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fab fa-behance"></i></a></li>
                           <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                           <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="offcanvas-overlay"></div>
      <div class="offcanvas-overlay-white"></div>
      <div class="fix">
         <div class="sidebar-action sidebar-cart">
            <button class="close-sidebar">Close<i class="fal fa-times"></i></button>
            <h4 class="sidebar-action-title">Shopping Cart</h4>
            <div class="sidebar-action-list">
               <div class="sidebar-list-item">
                  <div class="product-image pos-rel">
                     <a href="shop-details.html" class=""><img src="assets/img/product/product-6.png" alt="img"></a>
                  </div>
                  <div class="product-desc">
                     <div class="product-name"><a href="shop-details.html">Giardino Tools</a></div>
                     <div class="product-pricing">
                        <span class="item-number">1 ×</span>
                        <span class="price-now">$24.00</span>
                     </div>
                     <button class="remove-item"><i class="fal fa-times"></i></button>
                  </div>
               </div>
               <div class="sidebar-list-item">
                  <div class="product-image pos-rel">
                     <a href="shop-details.html" class=""><img src="assets/img/product/product-8.png" alt="img"></a>
                  </div>
                  <div class="product-desc">
                     <div class="product-name"><a href="shop-details.html">Bloom Season</a></div>
                     <div class="product-pricing">
                        <span class="item-number">1 ×</span>
                        <span class="price-now">$12.00</span>
                     </div>
                     <button class="remove-item"><i class="fal fa-times"></i></button>
                  </div>
               </div>
               <div class="sidebar-list-item">
                  <div class="product-image pos-rel">
                     <a href="shop-details.html" class=""><img src="assets/img/product/product-10.png" alt="img"></a>
                  </div>
                  <div class="product-desc">
                     <div class="product-name"><a href="shop-details.html">the best dirt</a></div>
                     <div class="product-pricing">
                        <span class="item-number">1 ×</span>
                        <span class="price-now">$42.00</span>
                     </div>
                     <button class="remove-item"><i class="fal fa-times"></i></button>
                  </div>
               </div>
            </div>
            <div class="product-price-total">
               <span>Subtotal :</span>
               <span class="subtotal-price">$78.00</span>
            </div>
            <div class="sidebar-action-btn">
               <a href="cart.html" class="fill-btn">View cart</a>
               <a href="checkout.html" class="border-btn">Checkout</a>
            </div>
         </div>
      </div>
