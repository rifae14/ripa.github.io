<?php
/**
 * Help Panel.
 *
 * @package wedding_ceremony
 */
?>

<div id="help-panel" class="panel-left visible">
    <div id="#help-panel" class="steps">  
        <h4 class="cc">
            <?php esc_html_e( 'Quick Setup for Home Page', 'wedding-ceremony' ); ?>
            <a href="<?php echo esc_url( 'https://demo.asterthemes.com/docs/wedding-ceremony-free' ); ?>" class="button button-primary" style="margin-left: 5px; margin-right: 10px;" target="_blank"><?php esc_html_e( 'Free Documentation', 'wedding-ceremony' ); ?></a>
        </h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to the Dashboard. navigate to pages, add a new one, and label it "home" or whatever else you like.The page has now been created.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '2) Go back to the Dashboard and then select Settings.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '3) Then Go to readings in the setting.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '4) There are 2 options your latest post or static page.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '5) Select static page and select from the dropdown you wish to use as your home page, save changes.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '6) You can set the home page in this manner.', 'wedding-ceremony' ); ?></p>
        <hr>
        <h4><?php esc_html_e( 'Setup Banner Section', 'wedding-ceremony' ); ?></h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to Dashboard > Go to Appereance > then Go to Customizer.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '2) In Customizer > Go to Front Page Options > Go to Banner Section.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '3) For Setup Banner Section you have to create post in dashbord first.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '4) In Banner Section > Enable the Toggle button > and fill the following details.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '5) In this way you can set Banner Section.', 'wedding-ceremony' ); ?></p>
        <hr>
        <h4><?php esc_html_e( 'Setup About Us Section', 'wedding-ceremony' ); ?></h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to Dashboard > Go to Appereance > then Go to Customizer.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '2) In Customizer > Go to Front Page Options > Go to About Us Section.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '3) In About Us Section > Enable the Toggle button > and fill the following details which you want.', 'wedding-ceremony' ); ?></p>
        <p><?php esc_html_e( '4) In this way you can set About Us Section.', 'wedding-ceremony' ); ?></p>
    </div>
    <hr>
    <div class="custom-setting">
        <h4><?php esc_html_e( 'Quick Customizer Settings', 'wedding-ceremony' ); ?></h4>
        <span><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'wedding-ceremony' ); ?></a></span>
    </div>
    <hr>
   <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-admin-site-alt3"></span>
            </div>
            <h5><?php esc_html_e( 'Site Logo', 'wedding-ceremony' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'wedding-ceremony' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-color-picker"></span>
            </div>
            <h5><?php esc_html_e( 'Color', 'wedding-ceremony' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=primary_color' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'wedding-ceremony' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-screenoptions"></span>
            </div>
            <h5><?php esc_html_e( 'Theme Options', 'wedding-ceremony' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=wedding_ceremony_theme_options' ) ); ?>"target="_blank" class=""><?php esc_html_e( 'Customize', 'wedding-ceremony' ); ?></a>
            
        </div>
    </div>
    <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-format-image"></span>
            </div>
            <h5><?php esc_html_e( 'Header Image ', 'wedding-ceremony' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=header_image' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'wedding-ceremony' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-align-full-width"></span>
            </div>
            <h5><?php esc_html_e( 'Footer Options ', 'wedding-ceremony' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=wedding_ceremony_footer_copyright_text' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'wedding-ceremony' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-admin-page"></span>
            </div>
            <h5><?php esc_html_e( 'Front Page Options', 'wedding-ceremony' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=wedding_ceremony_front_page_options' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'wedding-ceremony' ); ?></a>
            
        </div>
    </div>
</div>


