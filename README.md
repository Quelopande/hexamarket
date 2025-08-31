[![License: CC BY-ND 4.0](https://licensebuttons.net/l/by-nd/4.0/80x15.png)](http://creativecommons.org/licenses/by-nd/4.0/)
[![License: CC BY-ND 4.0](https://img.shields.io/badge/License-CC%20BY--ND%204.0-lightgrey.svg)](http://creativecommons.org/licenses/by-nd/4.0/)
This repositorie is under CC BY-ND 4.0 License. This is a platform were you can upload different resources of different games. There is only one paying method that is Paypal for allows tranfer as much as possible money to the publisher amount.

***Warning❗:*** This repository is **discontinued**, I don't recommend using it.

## Issues (Why you should not use it)
- XSS vulnerabilities: The output is not managed correctly.
- CSRF vulnerability: The code doesn't check if the user has sent the form in purpose.
- The code structure isn't Front Controller: This can lead to some data breaches and information to be in public html.
- Some information is stored in the public_html folder, this is bad because the user's private information could be leaked.
- There's a folder called mails that sends a email with outcheking anything, this can lead to email spamming and some crashes.
- Optimization error: When a user is signs up, the code creates a custom page for the user using a template. This isn't good because creating pages for each user or post would fill the memory space.
- The code uses from libraries and functions from other PHP versions, the code could not run correctly.