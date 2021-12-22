# Refactoring Kata Test

## Explanations

1/First of all, I analysed how the code works.

2/I analyzed the code to see if there was any duplicate and I found the text "Bonjour {firstname}, Merci d'avoir contacté un agent local pour votre voyage {countryName}". And I found that $faker->randomNumber() was used multiple times so I placed it in a variable 

3/ I updated PHPUNIT because the new version doesn't need setUp() and tearDown() methods in the TemplateManagerTest.php

4/I analyzed the code to see if there was any unusefull variables, functions, methods, or anything else. So I erased everything that was not usefull or is not usefull anymore (like everything that used [quote:summary] or [quote:summary_html] for exemple).

