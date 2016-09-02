
setenv PATH /home/scf-19/lupengwa/tmp/lupengwa/mysql-5.0.41-solaris9-sparc/bin:$PATH
setenv MYSQL_UNIX_PORT /home/scf-19/lupengwa/mysql.sock
setenv MYSQL_TCP_PORT 9580
setenv LD_LIBRARY_PATH /home/scf-19/lupengwa/apache2/libexec



#
# $Header: /src/common/usc/skel/RCS/dot.cshrc,v 1.5 1994/06/20 20:48:05 ucs Exp $
#

#
# If this is not an interactive shell, then we exit here.
#
if (! $?prompt) then
	exit 0
endif

#
# RC Revision Date
#
set rcRevDate=930824

#
# Set User Level of expertise.
#
set UserLevel=novice

###############################################################################
#
# Source a global .cshrc file.  
#
# DO NOT DELETE THIS SECTION!
#
# If you wish to customize your own environment, then add things AFTER
# this section.  In this way, you may override certain default settings,
# but still receive the system defaults.
#
if (-r /usr/lsd/conf/master.cshrc) then
	source /usr/lsd/conf/master.cshrc
else if (-r /usr/local/lib/master.cshrc) then
	source /usr/local/lib/master.cshrc
endif
###############################################################################

#
# Put your changes/additions, here.
#


