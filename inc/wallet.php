<?php

// Wallet Information



function display_user_registries() {
    $user_id = get_current_user_id();
    $registries = get_user_meta($user_id, '_user_registries', true);



    if ($registries) {

        echo "<div class='user_reg'>";
       
        foreach ($registries as $registry) {
            // Get the product details
            $registry_id = esc_html($registry['registry_id']);
            $product_name = esc_html($registry['product_name']);
            $registry_number = esc_html($registry['registry_number']);
            $brand_name = esc_html($registry['brand_name']);
            $image_url = esc_url($registry['image_url']); // Assuming 'image_url' is stored in the registry array

            echo "<div>";
             if ($image_url) {
            
                echo '<img src="' . $image_url . '" alt="' . $product_name . '" style="max-width: 200px; max-height: 200px;"/>';
            }
            echo '</div>';

            echo "<ul>";
            echo '<li>';
            echo '<strong>Registry ID:</strong> ' . $registry_id . '<br>';
            echo '<strong>Product Name:</strong> ' . $product_name . '<br>';
            echo '<strong>Registry Number:</strong> ' . $registry_number . '<br>';
            echo '<strong>Brand Name:</strong> ' . $brand_name . '<br>';
            echo "</li>";
            echo "<li>  <p id='walletStatus'></p> </li>";
            echo '</ul>';
            
           
        }
        echo '</div>';
       
    } else {
        echo '<p>No registries found.</p>';
    }
}

function registries_content() {
    // Check if the user has registries saved in their meta
    $user_id = get_current_user_id();
    $registries = get_user_meta($user_id, '_user_registries', true);
    
    ?>
    <h2 id="connectHeading">Checking Wallet Connection...</h2>

    <button id="connectWallet" class="button" style="display: none;">Connect Wallet</button>
    
    <div id="userRegistriesDiv" style="display: none;">
        <?php display_user_registries(); ?>
    </div>

   
    <div id="registriesList"></div>

    <script>
        document.addEventListener("DOMContentLoaded", async function () {
            const userRegistriesDiv = document.getElementById('userRegistriesDiv');
            const connectWalletButton = document.getElementById('connectWallet');
            const connectHeading = document.getElementById('connectHeading');

            if (window.ethereum) {
                try {
                    const accounts = await window.ethereum.request({ method: 'eth_accounts' });

                    if (accounts.length > 0) {
                        // Wallet is already connected
                        const walletAddress = accounts[0];
                        document.getElementById('walletStatus').innerText = "Address: " + walletAddress;
                        connectHeading.innerText = "Wallet Connected";

                        // Show userRegistriesDiv
                        userRegistriesDiv.style.display = "block";
                    } else {
                        // Show the connect button if no wallet is connected
                        connectHeading.innerText = "Connect Your Wallet";
                        connectWalletButton.style.display = 'block';
                    }
                } catch (error) {
                    console.error("Error checking wallet connection:", error);
                }
            } else {
                document.getElementById('walletStatus').innerText = "MetaMask is not installed!";
            }

            // Wallet connect button event listener
            connectWalletButton?.addEventListener('click', async () => {
                if (window.ethereum) {
                    try {
                        const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
                        const walletAddress = accounts[0];

                        document.getElementById('walletStatus').innerText = "Connected: " + walletAddress;
                        connectHeading.innerText = "Wallet Connected";
                        connectWalletButton.style.display = 'none';

                        // Show userRegistriesDiv after connecting
                        userRegistriesDiv.style.display = "block";

                    } catch (error) {
                        console.error(error);
                    }
                } else {
                    document.getElementById('walletStatus').innerText = "MetaMask is not installed!";
                }
            });
        });
    </script>
    <?php
}
add_action('woocommerce_account_registries_endpoint', 'registries_content');
