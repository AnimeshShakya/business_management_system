<?php
    $fcmCredentials = \Modules\BusinessSettingsModule\Entities\BusinessSettings::where(['key_name' => 'firebase_message_config'])->first()?->live_values;
    $firebaseOtpConfig = business_config('firebase_otp_verification', 'third_party');
    $firebaseOtpStatus = (int)$firebaseOtpConfig?->live_values['status'] ?? null;
?>
<span id="Firebase_Configuration_Config" data-api-key="{{ $fcmCredentials['apiKey'] ?? '' }}"
      data-auth-domain="{{ $fcmCredentials['authDomain'] ?? '' }}"
      data-project-id="{{ $fcmCredentials['projectId'] ?? '' }}"
      data-storage-bucket="{{ $fcmCredentials['storageBucket'] ?? '' }}"
      data-messaging-sender-id="{{ $fcmCredentials['messagingSenderId'] ?? '' }}"
      data-app-id="{{ $fcmCredentials['appId'] ?? '' }}"
      data-measurement-id="{{ $fcmCredentials['measurementId'] ?? '' }}"
      data-csrf-token="{{ csrf_token() }}"
      data-firebase-service-worker-file="{{ asset('firebase-messaging-sw.js') }}"
>
</span>

<script src="{{ 'https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js' }}"></script>
<script src="{{ 'https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js' }}"></script>
<script src="{{ 'https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js' }}"></script>
<script>
    try {
        let firebaseConfigurationConfig = $('#Firebase_Configuration_Config');
        var firebaseConfig = {
            apiKey: firebaseConfigurationConfig.data('api-key'),
            authDomain: firebaseConfigurationConfig.data('auth-domain'),
            projectId: firebaseConfigurationConfig.data('project-id'),
            storageBucket: firebaseConfigurationConfig.data('storage-bucket'),
            messagingSenderId: firebaseConfigurationConfig.data('messaging-sender-id'),
            appId: firebaseConfigurationConfig.data('app-id'),
            measurementId: firebaseConfigurationConfig.data('measurement-id'),
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        var recaptchaVerifiers = {};

        function initializeFirebaseGoogleRecaptcha(containerId, action) {
            try {
                var recaptchaContainer = document.getElementById(containerId);

                if (recaptchaVerifiers[containerId]) {
                    recaptchaVerifiers[containerId].clear();
                }

                if (recaptchaContainer && recaptchaContainer.innerHTML.trim() === "") {
                    recaptchaVerifiers[containerId] = new firebase.auth.RecaptchaVerifier(containerId, {
                        size: 'normal',  // Use 'invisible' for invisible reCAPTCHA
                        callback: function(response) {
                            console.log('reCAPTCHA solved for ' + containerId + ' with action ' + action);
                            storeRecaptchaVerifierResponse(containerId, response);
                        },
                        'expired-callback': function() {
                            console.error('reCAPTCHA expired for ' + containerId);
                        }
                    });

                    recaptchaVerifiers[containerId].render().then(function(widgetId) {
                        console.log('reCAPTCHA widget rendered for ' + containerId);
                    }).catch(function(error) {
                        console.error('Error rendering reCAPTCHA for ' + containerId + ':', error);
                    });
                } else {
                    console.log("reCAPTCHA container " + containerId + " is either not found or already contains inner elements!");
                }
            } catch (e) {
                console.log(e)
            }
        }

        @if($firebaseOtpConfig && $firebaseOtpStatus)
            window.onload = function() {
            initializeFirebaseGoogleRecaptcha('recaptcha-container-provider-registration', 'Provider Registration');
        };
        @endif

        function storeRecaptchaVerifierResponse(containerId, response) {
            console.log('Response from ' + containerId + ': ' + response);
        }

    } catch (e) {
        console.log(e);
    }

    try {
        function displayNotification(notification) {
            const options = {
                body: notification.body,
                icon: $('#Firebase_Configuration_Config').data('favicon'),
            };
            new Notification(notification.title, options);
        }
    } catch (e) {
        console.log(e);
    }
</script>
