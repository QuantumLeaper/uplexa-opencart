uPlexa OpenCart Plugin for OpenCart 3.x
==================
Prerequisites
-------------------
* uPlexa Node
* uPlexa Wallet RPC
* uPlexa Public Wallet address

The idea for uPlexa OpenCart is that it is a standalone payment processor. This means there is no middleman for collecting payments. Payments made using the uPlexa Opencart plugin go directly to the merchants UPX wallet.

Because of this, it is required to run your own uPlexa Node and Wallet RPC.

Installation
------------------------



### Option 1: Running a full node yourself

To do this: start the uPlexa daemon on your server and leave it running in the background. This can be accomplished by running `./uplexad` inside your uPlexa downloads folder. The first time that you start your node, the uPlexa daemon will download and sync the entire uPlexa blockchain. This can take several hours and is best done on a machine with at least 4GB of ram, an SSD hard drive (with at least 40GB of free space), and a high speed internet connection.
You can refer the official documentation for running full node from [here](https://github.com/uplexa/uplexa).

### Option 2: Connecting to a remote node
Use a remote node to connect, remote.uplexa.com:21061 will automatically connect you to a random uplexa node.

`Note: You must run your JSON RPC on the host server of OpenCart against your wallet`

### Setup your uPlexa wallet-rpc

* Setup a uPlexa wallet using the uplexa-wallet-cli tool. If you do not know how to do this you can learn about it at [https://github.com/uplexa/uplexa](https://github.com/uplexa/uplexa)



* Start the Wallet RPC and leave it running in the background. This can be accomplished by running `uplexa-wallet-rpc --wallet-file /path/to/wallet/file --password walletPassword --rpc-bind-port 21065 --disable-rpc-login` where "/path/to/wallet/file" is the wallet file for your uPlexa wallet. If you wish to use a remote node you can add the `--daemon-address` flag followed by the address of the node. `--daemon-address remote.uplexa.com:21061` for example.

## Step 4: Setup uPlexa Gateway in OpenCart
To install the uPlexa OpenCart plugin, upload all files to their corresponding locations.
* Visit the Admin Panel.
* Go to Extensions -> Payments, and click "install" for the "uPlexa Payment Gateway".
* Now, click the edit pencil to configure the settings.ick on `configure`.
* Update `uPlexa Wallet Address` and `Wallet RPC IP/HOST`
* Note: Wallet RPC IP should start with the protocol and end with port address. `Eg. http://127.0.0.1:21065`
* Save the changes and you are good to go.
