 <?php wp_footer();
    $instagram  = get_theme_mod('naghshineh-instagram');
    $telegram   = get_theme_mod('naghshineh_telegram');
    $linkedin = get_theme_mod('naghshineh_linkedin');
    ?>
 <footer class="bg-[#fff6eb] p-6 mt-20">
     <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row gap-6 border-t-2 border-[#940303]">
         <div class="w-60 sm:w-80 h-auto p-5">
             <h3" class="text-[#950909]">درباره ما</h3>
                 <p class="font-light text-gray-700">نقشینه فقط میراث دار گذشتگان نیست بلکه امانت دار آیندگان هم هست.</p>
         </div>
         <div class="w-60 sm:w-80 h-auto p-5">
             <h3" class="text-[#950909]">لینک های مفید</h3>
                 <nav class="font-light  text-gray-700">
                     <?php
                        wp_nav_menu([
                            'theme_location' => 'Footer',
                            //'menu_class' => 'text-gray-700 text-base',
                            'container' => 'nav',
                        ]); ?>
                 </nav>
         </div>
         <div class="w-60 sm:w-80 h-auto p-5">
             <h3" class="text-[#950909]">ارتباط با ما</h3>
                 <table class="border-separate border-spacing-2 font-light  text-gray-700">
                     <tr>
                         <td>آدرس:</td>
                         <td>ایران-خراسان رضوی-مشهد</td>
                     </tr>
                     <tr>
                         <td>تلفن:</td>
                         <td>09304444333</td>
                     </tr>
                     <tr>
                         <td>ایمیل:</td>
                         <td>naghshineh-shop@gmail.com</td>
                     </tr>
                 </table>
                 <div class="mt-6">
                     <h3" class="text-[#950909]">صفحات مجازی</h3>
                         <div class="flex gap-3 mt-2">
                             <?php if ($instagram): ?>
                                 <a href="<?php echo esc_url($instagram); ?>" target="_blank" class="aspect-square w-10 items-center flex rounded-full border-2 border-gray-300 justify-center">
                                     <svg width="7" height="16" viewBox="0 0 7 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M1.55073 15.5V7.99941H0V5.41457H1.55073V3.86264C1.55073 1.75393 2.42638 0.5 4.91418 0.5H6.98534V3.08514H5.69072C4.72228 3.08514 4.65821 3.44637 4.65821 4.12054L4.65469 5.41428H7L6.72556 7.99912H4.65469V15.5H1.55073Z" fill="#0A142F" />
                                     </svg>

                                 </a>
                             <?php endif; ?>

                             <?php if ($telegram): ?>
                                 <a href="<?php echo esc_url($telegram); ?>" target="_blank" class="aspect-square w-10 items-center flex rounded-full border-2 border-gray-300 justify-center">
                                     <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M6.31224 3.42617L6.34042 3.90195L5.87076 3.84369C4.16119 3.62037 2.66767 2.863 1.39959 1.59102L0.779637 0.959879L0.619952 1.42595C0.281797 2.4649 0.497841 3.56211 1.20233 4.30006C1.57806 4.70787 1.49352 4.76613 0.84539 4.52338C0.619952 4.4457 0.422695 4.38744 0.403908 4.41657C0.338156 4.48454 0.563593 5.36814 0.742064 5.71769C0.986288 6.20318 1.48413 6.67896 2.02893 6.96055L2.4892 7.18387L1.9444 7.19358C1.41838 7.19358 1.39959 7.20329 1.45595 7.4072C1.64381 8.03834 2.38588 8.70831 3.21248 8.99961L3.79486 9.20351L3.28763 9.51423C2.53617 9.96088 1.65321 10.2133 0.770244 10.2328C0.347549 10.2425 0 10.2813 0 10.3104C0 10.4075 1.14597 10.9513 1.81289 11.1649C3.81365 11.796 6.19013 11.5242 7.97484 10.4464C9.24293 9.67929 10.511 8.15485 11.1028 6.67896C11.4222 5.89247 11.7415 4.45541 11.7415 3.76602C11.7415 3.31936 11.7697 3.2611 12.2957 2.72707C12.6057 2.41635 12.8969 2.07651 12.9532 1.97941C13.0472 1.79492 13.0378 1.79492 12.5587 1.95999C11.7603 2.25128 11.6476 2.21245 12.0421 1.7755C12.3333 1.46479 12.6808 0.90162 12.6808 0.736553C12.6808 0.707424 12.5399 0.755973 12.3803 0.843361C12.2112 0.940459 11.8355 1.08611 11.5537 1.17349L11.0464 1.33856L10.5862 1.01814C10.3325 0.843361 9.9756 0.649165 9.78773 0.590906C9.30868 0.454968 8.57601 0.474388 8.14392 0.629745C6.96977 1.06669 6.2277 2.19303 6.31224 3.42617Z" fill="#0A142F" />
                                     </svg>

                                 </a>
                             <?php endif; ?>

                             <?php if ($linkedin): ?>
                                 <a href="<?php echo esc_url($linkedin); ?>" target="_blank" class="aspect-square w-10 items-center flex rounded-full border-2 border-gray-300 justify-center">
                                     <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M3 14.5H0V5.5H3V14.5Z" fill="#0A142F" />
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M1.49108 3.5H1.47404C0.578773 3.5 0 2.83303 0 1.99948C0 1.14831 0.5964 0.5 1.50865 0.5C2.42091 0.5 2.98269 1.14831 3 1.99948C3 2.83303 2.42091 3.5 1.49108 3.5Z" fill="#0A142F" />
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9999 14.4998H11.0519V9.79535C11.0519 8.61371 10.6253 7.80738 9.55814 7.80738C8.74368 7.80738 8.25855 8.35096 8.04549 8.87598C7.96754 9.06414 7.94841 9.3263 7.94841 9.58911V14.5H5C5 14.5 5.03886 6.53183 5 5.70672H7.94841V6.95221C8.33968 6.35348 9.04046 5.5 10.6057 5.5C12.5456 5.5 14 6.75705 14 9.45797L13.9999 14.4998Z" fill="#0A142F" />
                                     </svg>

                                 </a>
                             <?php endif; ?>
                         </div>
                 </div>
         </div>
         <div class="w-60 sm:w-80 h-auto p-5">
             <a href="#"><img class="rounded-xl" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsRU52x1tKDRUucWWHcHJBeTKD7k8nyNfrYA&s"></a>
         </div>
     </div>
     <div class="mt-6">
         <p class="text-center text-gray-600">تمامی حقوق این سایت برای فروشگاه <a href="page-home.php"><span class="text-[#950909]">نقشینه</span></a> محفوظ میباشد ©</p>
     </div>



     </div>

 </footer>
 </body>

 </html>