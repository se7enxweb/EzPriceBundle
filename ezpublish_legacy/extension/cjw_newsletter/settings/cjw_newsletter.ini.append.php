#?ini charset="utf-8"?
# cjw_newsletter.ini contains settings for the newsletter

[NewsletterSettings]
# NodeId of container where the system is looking for newsletter systems
RootFolderNodeId=7785

# which is the command to exex php cli scripts
PhpCli=php

# array with all skin names located in design folder
# => design:newsletter/skin/ $skin_name


AvailableSkinArray[]=efl


[NewsletterMailSettings]

# smtp, sendmail, file

# newsletter
TransportMethodCronjob=smtp

# test newsletter
TransportMethodPreview=smtp

# subscribe, infomail
TransportMethodDirectly=smtp

# where to store mails send by TransportMethod = file
FileTransportMailDir=var/log/mail

# http://ezcomponents.org/docs/api/latest/introduction_Mail.html#mta-qmail
# HeaderLineEnding
#    auto - try to find correct settings
#           default is LF
#    CRLF - windows - \r\n
#    CR   - mac - \r
#    LF   - UNIX-MACOSX - \n
HeaderLineEnding=auto

# Configuration for SMTP
SmtpTransportServer=localhost
SmtpTransportPort=25
#SmtpTransportUser=smtp@desorden.net
#SmtpTransportPassword=smtp

# settings for mail send out by subscribe, unsubscribe
EmailSender=clientes@efl.es
EmailSenderName=newsletter lefebvre

# string the subject of all mails is starting with
EmailSubjectPrefix=

# enabled | disabled - if enabled all local images will be include to the mail message
ImageInclude=enabled

[BounceSettings]
# when we should nl user status to bounced?
BounceThresholdValue=3

[DebugSettings]
# Debug=enabled|disabled get more log output e.g. bounce parser
Debug=disabled

[NewsletterUserSettings]

# if disabled nl_user.name is created with default shema
# saluation first_name last_name
# if enabled the tpl design:newsletter/user/name.tpl will be used
UseTplForNameGeneration=disabled

# define which salutaions are available
# mapping of nl_user.salutation (int) to english string
# this string is used for i18n
# SalutationMappingArray[value_{$saluataionid}]={i18n english string}
# i18n( {i18n english string}, 'cjw_newsletter/user/salutation' )
SalutationMappingArray[value_1]=Mr
SalutationMappingArray[value_2]=Ms