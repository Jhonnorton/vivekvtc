php .\vendor\doctrine\doctrine-module\bin\doctrine-module orm:convert-mapping --namespace="Base\Entity\Avp\\" --force  --from-database annotation .\module\Base\src\ 
php .\vendor\doctrine\doctrine-module\bin\doctrine-module orm:generate-entities .\module\Base\src\ --generate-annotations=true 
