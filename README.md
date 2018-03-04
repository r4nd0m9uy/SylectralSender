# SylectralSender
Send sms texts using Twillio as SMS service

## Installation
1. Download the folder and serve it to the web.
2. Use database.sql to configure the needed tables.
3. Set the database connection in **database_connection/connection.php**
   * Open the connection.php file in the database_connection folder
   * Set the servername, the username, the password and the dbname
4. Set your values in the following files:
   * **incoming_message.php**: replace domain.com/ with the path to this folder
   * **mailer.php**: set the mail recipient to receive the incoming messages
5. Set the Account Sid and Auth Token from twilio.com/user/account in the cron_check.php file
6. Set your twillio application to call **/incoming_message.php** when an incoming message is detected.


## Usage
### Outbound
1. Send messages by calling **prepare_message.php** with following GET variables
   * `text`: This variable takes the message to send to the recipient. The message can contain all ascii characters.
   * `contact`: This variable contains the mobile phone number of the recipient. The following format should be used: ##4123123 (Where ## is the country code without leading zeroes.). E.g.: 324123123 (Belgian mobile number)
   * `name`: This variable is optional and contains the name of the recipient. If the name is given, the mail sent to you will contain the name of the recipient.
   * `date`: This variable is optional and contains the timestamp of when the message should be sent. Format: YYYY-MM-DD HH:mm.

2. Set a cron job to call **cron_check.php**

### Inbound
1. Inbound messages are sent to the mail address set in the **mailer.php** file.

## Development
I'm actively working on this project. If you have questions, ideas for enhancement or if you find any bugs in the scripts, feel free to open an issue!

## Copyright
This project is licensed under the MIT license. Please feel free to use this code, modify it or redistribute it. 
