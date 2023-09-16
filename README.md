# BeverageMachine-PM5
Simple drinks machine

FR: Voici un système de Machine à Boisson !

Le plugin est full configurable dans le config.yml

- Comme plugin nécessaire il vous faut:

  - Customies
  - EconomyAPI
  - FormAPI

- Pour faire spawn la Machine à boisson il faut faire la commande /spawnentity

- Pour la retirer, dans l'inventaire une clé à molette sera à votre dispostion

- PS: C'est la toute première version du Plugin donc possible que certain bug soit au rendez-vous, merci de me report !

EN: Here is a Drink Machine system!

- The plugin is fully configurable in the config.yml

- As a necessary plugin you need:

 - Customies
 - EconomyAPI
 - FormAPI

- To spawn the Drink Machine you must do the command /spawnentity

- To remove it, in the inventory an adjustable wrench will be at your disposal

- PS: This is the very first version of the Plugin so some bugs may be present, please let me know!

![image](https://github.com/mathchat900/BeverageMachine-PM5/assets/73251064/de516033-fe4a-4b0b-bd61-b55a372551cf)

# Config
```config
---

#English translation
#Plugin created by Mathchat

#menu
title-menu: "Beverage machine"
content-menu: "§l§c» §rClick a button to get your drink!"
close-menu: "§cClose"
prix-lipton: 1500 #amount in dollars
prix-coca: 1500 #amount in dollars
prix-orangina: 1500 #amount in dollars
prix-fanta: 1500 #amount in dollars
no-money-coca: "§cYou don't have the money to buy this item."
no-money-lipton: "§cYou don't have the money to buy this item."
no-money-orangina: "§cYou don't have the money to buy this item."
no-money-fanta: "§cYou don't have the money to buy this item."


#text in the chat
text-coca: "§aYou just got a Coca-Cola."
text-lipton: "§aYou just got an Lipton."
text-orangina: "§aYou have just got an Orangina."
text-fanta: "§aYou have just got a Fanta."
text-entity-withdraw: "§aThe entity has been removed."

#name above the drink machine
title-machine: "§cBeverage machine"
break-machine: "§aYou just broke the machine."

#command
command-description: "Allows you to spawn the Beverage machine"
command-success-placed-entity: "§aThe entity has been placed successfully."
command-permission: "§cYou don't have permission to use this command."

...
```

