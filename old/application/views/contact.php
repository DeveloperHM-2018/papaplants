<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('include/headerlink.php') ?>
</head>
<body>
    <?php $this->load->view('include/header') ?>
    <!-- banner area  -->
    <section class="page-title-area">
		<div class="breadcrumb-wrapper">
			<div class="container">
				<div class="breadcrumb-menu">
					<nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
						<ul class="trail-items">
							<li class="trail-item trail-begin">
								<a href="<?= base_url() ?>"><span>home</span></a>
							</li>
							<li class="trail-item trail-end"><span>Contact Us</span></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</section>
<!-- banner area end  -->
    <?php include "include/contact-form.php" ?>
    <section class="contact-info-area">
         <div class="contact-info-shape">
            <img class="contact-img-1" src="<?= base_url() ?>assets/img/about/shovle-img.png" alt="img not found">
         </div>
         <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay=".3s">
               <div class="col-lg-8">
                  <div class="section-title text-center">
                     <span class="section-subtitle">contact</span>
                     <h2 class="section-main-title mb-45">get in touch</h2>

                  </div>
               </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay=".3s">
               <div class="col-lg-4">
                  <div class="contact-map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3666.2660549872503!2d77.43134528026917!3d23.233403554369765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397c4247b76cf5a5%3A0x1fcfb60494e84191!2sWebangel%20Technologies%20LLP!5e0!3m2!1sen!2sin!4v1690309400930!5m2!1sen!2sin"   style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="info-item-wrapper info-wrapper-media">
                     <h4 class="contact-info-title">head quarter</h4>
                     <div class="info-contact">
                        <ul>
                           <li>
                              <div class="single-contact">
                                 <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                 </div>
                                 <p><a href="tel:<?= $this->contact['f_contact'] ?>"><?= $this->contact['f_contact'] ?></a></p>
                              </div>
                           </li>
                           <li>
                              <div class="single-contact">
                                 <div class="contact-icon">
                                    <i class="fas fa-envelope-open"></i>
                                 </div>
                                 <p><a href="mailto:<?= $this->contact['f_email'] ?>"><?= $this->contact['f_email'] ?></span></a></p>
                              </div>
                           </li>
                           <li>
                              <div class="single-contact">
                                 <div class="contact-icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                 </div>
											<p><a href="mailto:<?= $this->contact['address'] ?>"><?= $this->contact['address'] ?></span></a></p>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="info-item-wrapper info-wrapper-time">
						<br>
                     <h4 class="contact-info-title">Embrace nature.<br><br> Embrace life. <br><br>Embrace PapaPlants.</h4>

                  </div>
               </div>
            </div>
         </div>
      </section>
		<?php $this->load->view('include/footer') ?>
	<?php $this->load->view('include/footerlink') ?>
</body>
</html>
