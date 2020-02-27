#Projet 7 - BileMo Api

[![CodeFactor](https://www.codefactor.io/repository/github/captainfrak/projet7/badge)](https://www.codefactor.io/repository/github/captainfrak/projet7)

#(1) Install

Clone the repository :

    https://github.com/captainfrak/Projet8.git
    
in terminal run :

    composer install

import the database in your phpAdmin

and don't forget to add your config in .env file

    DATABASE_URL=mysql://user:password@db_adress:db_port/db_bilemo
    
#(2) Create the JWT keys

In terminal cd to your project and write this :

    $ mkdir -p config/jwt
    $ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
    $ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
    
It will ask you a secret phrase.
Once you've finished the process, go to the .env file and write your secret phrase in

    JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
    JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
    JWT_PASSPHRASE="The secret phrase here"
    
#(3) "Login"

To log in the app you have to create a JWT first. In terminal write :

To be log as an Admin:

    curl -X POST -H "Content-Type: application/json" http://127.0.0.1:8000/authentication_token -d '{"email":"client@sfr.fr","password":"testtest"}'
    
To be log as an User:

    curl -X POST -H "Content-Type: application/json" http://127.0.0.1:8000/authentication_token -d '{"email":"test@bilemo.com","password":"testtest"}'
    
If it worked, you have something like this:

    {
    "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1ODI4MDYwMDUsImV4cCI6MTU4MjgwOTYwNSwicm9sZXMiOlsiUk9MRV9BRE1JTiJdLCJ1c2VybmFtZSI6ImNsaWVudEBzZnIuZnIifQ.kDZEolrXc1fAhKlCofZhmHQuXI4Tte-d5BPL3RmsWBaWqOabjOc6ZGTble1BwP0WJ0FEGmmrGdvedMhN_4WgZ45lAcfA5-n_3gaCBoSrVt1nTFRjOkLjBgemTEYOlWdueJQ4k-puiymzC2DZ26GGArXcb4qzxj0-cVf9D-R7Wob9rz7JjLryGZfQxtL2fgZNv7br3S8-kDFwlFa0HlwDT5auSETaAHHCZLYmHC1K3kqFwq9jW2PVgn-QCl9UknCK6Skga7fr8Jj0b25RrL-4c4C8460JSqSUY2qyuBHN_q5Mab_S5CFM3dDVit2LisAe73XA6oKLZQXHmLU6opyyiXBVMIWKniP4Of2wmIU0kBtN8tdPLGeVFr5X0-Ir9yu8hIPTXhPOv2M5_3l1HKVPyd0Zi2Y8myzWSkeDZIcUZpcDAG4tWQIUCpWKL0sUHt-Tsn-WrSnQCJyjqPZt4Bwkj5Ce9jRJ9lGzq96ppckHAH4WzHAB38EFCy7DXOABAK555H0OijZCHUjRjBQspHCXbvjBXDDc0APRLMFn0ZOKsV3GuZ3dRs8LVGCMocrSorp_Pg8DnIGyJcWeA1iHdBxaTCMOsnTtIkKSv8AsouC7PosbpADjRL31lIsqVfqxWj1YVGE7X6mf2Vrqm9WFRJeyJJPh6sL2YTQMJEtMeidvwoo"
    }
    
Now copy the token. The token is valid for 1 hour, after the hour, just do the process to get a new token

I recomand to use postman (https://www.postman.com/) to try the API, enjoy !