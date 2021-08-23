<?php
style("sciencemesh", "settings-admin");
script("sciencemesh", "settings-admin");
?>
<section id="sciencemesh-admin" class="section section-sciencemesh">
    <h2 id="sciencemesh">
        <?php p($l->t('ScienceMesh Settings')); ?>
    </h2>

    <fieldset id="sciencemesh-site-settings">
        <legend><?php p($l->t("Site Settings")) ?></legend>
        <label><?php p($l->t("API Key")) ?>
            <input id="sciencemesh-api-key" value="<?php p($_["apiKey"]) ?>" placeholder="" type="text">
            <em>An API key is needed to register your site with ScienceMesh. If you do not have a key yet, you can register for a free ScienceMesh account using <a href="https://iop.sciencemesh.uni-muenster.de/iop/siteacc/register" target="_blank">this link</a>.</em>
        </label>
        <label for="sciencemesh-site-id"><?php p($l->t("Site ID")) ?>
            <input id="sciencemesh-site-id" value="<?php p($_["siteId"]) ?>" placeholder="" type="text">
            <em>The ID of this site.</em>
        </label>
        <label><?php p($l->t("Site Name")) ?>
            <input id="sciencemesh-site-name" value="<?php p($_["siteName"]) ?>" placeholder="CERN" type="text">
            <em>The name of this site.</em>
        </label>
        <label><?php p($l->t("Site URL")) ?>
            <input id="sciencemesh-site-url" value="<?php p($_["siteUrl"]) ?>" placeholder="https://nextcloud.example.com" type="text">
            <em>The URL at which your site can be reached.</em>
        </label>
        <label><?php p($l->t("Country Code")) ?>
            <input id="sciencemesh-country" value="<?php p($_["country"]) ?>" placeholder="CH" type="text">
            <em>The 2- or 3-digit code of the site's country. A list of all codes can be found <a href="https://www.nationsonline.org/oneworld/country_code_list.htm" target="_blank">here</a>.</em>
        </label>
    </fieldset>

    <fieldset id="sciencemesh-iop-settings">
        <legend><?php p($l->t("IOP Settings")) ?></legend>
        <label><?php p($l->t("IOP Service Address")) ?>
            <input id="sciencemesh-iop-url" value="<?php p($_["iopUrl"]) ?>" placeholder="https://nextcloud.example.com/iop" type="text">
            <em>The main URL of your IOP service. If the IOP is running on the same host as this NextCloud instance, you can simply use <strong>http://localhost:&#x3C;iop-port&#x3E;</strong> here.</em>
        </label>
    </fieldset>

    <fieldset id="sciencemesh-metrics-settings">
        <legend><?php p($l->t("Metrics")) ?></legend>
        <em><strong>Note: </strong>The following settings need to be provided manually for now, as they are not yet extracted automatically from Nextcloud. This will change in the future, though.</em>
        <label><?php p($l->t("Number of users")) ?>
            <input id="sciencemesh-num-users" value="<?php p($_["numUsers"]) ?>" placeholder="0" type="number">
        </label>
        <label><?php p($l->t("Number of files")) ?>
            <input id="sciencemesh-num-files" value="<?php p($_["numFiles"]) ?>" placeholder="0" type="number">
        </label>
        <label><?php p($l->t("Storage volume (in bytes)")) ?>
            <input id="sciencemesh-num-storage" value="<?php p($_["numStorage"]) ?>" placeholder="0" type="number">
        </label>
    </fieldset>

</section>
