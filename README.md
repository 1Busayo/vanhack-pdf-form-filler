
```
#############################
# INSTALLATION INSTRUCTIONS	#
#############################

install pdftk https://www.pdflabs.com/tools/pdftk-server/#download
set enviroment variables for pdftk directory 

Open on your terminal  type pdftk  to see if it working


1. Unzip the pdf-form-filler
2. Change the absolute path to pdftk in pdftk-php.php near line 71
	a. If you don't know what it is, type "whereis pdftk" or "which pdftk" at the console.
3. Set up the database.
	a. Run the sql commands found in database.sql to create the basic database structure.
	b. Change the credentials in _dbConfig.php to correspond with the new database.
4. Navigate to the site on your server and start playing with the site.

* If you want to experiment with submitting data from a PDF to the server, open example-submittable.pdf in Acrobat Professional and change the submit URL in the properties of the submit button toindex.php on your server.
```
