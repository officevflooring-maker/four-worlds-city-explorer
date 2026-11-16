# The Stripe store: how it works and how to switch it on

Lemon Squeezy turned the store down on Nov 16, 2026 ("winding down and no longer accepting new stores"), so the
shop moved to Stripe. Everything Lemon Squeezy did is now done by this site's own Worker and Stripe:

| Before (Lemon Squeezy) | Now (Stripe) |
|---|---|
| Checkout page and receipts | Stripe Checkout and Stripe's receipts |
| Seller of record, sales tax | Stripe Managed Payments (Stripe is the seller of record and handles sales tax, as Lemon Squeezy did) |
| Delivered the PDFs | The buyer lands on their own download page, `atlasofcities.org/dl/TOKEN/` (the PDFs already in the site's file store, the cleaned Nov 11 builds) |
| Life RPG license keys | The download page shows a key `LIFE-XXXX-XXXX-XXXX-XXXX`; the Life RPG Worker checks it in the site's database |
| One product per item in the dashboard | Nothing to create in Stripe: names, prices and pictures come from `build/config.php` |

Every Stone Speaks' six packs sell through the same store (`STORE_ALSO` in `build/config.php`).

## How a sale works

1. A Buy button opens `/buy/SLUG/`. The Worker (`src/store.js`) asks Stripe for a checkout with that product's name,
   price, picture and tax category, and sends the buyer there.
2. The buyer pays on Stripe's page (card, Apple Pay, Google Pay, Link, and others Stripe picks).
3. Stripe sends them back to `/thanks/`, which checks the payment with Stripe and opens their download page.
   Stripe also sends a message to `/stripe-webhook`, so the order exists even if they close the tab.
4. The download page has the PDFs in US Letter and A4 (or the Life RPG key). The buyer bookmarks it.

The site keeps only what is needed to hand over the files: which product, the price, the date, and the download
page's address. No names, emails or card details (those stay with Stripe). The owner's numbers page,
`/stats/KEY/`, lists every order with a link to its download page, so a buyer who lost theirs can be sent it again:
match the time and price with Stripe's email about the sale.

**Safety nets.** While the Worker has no live Stripe key, or a product's PDFs aren't in the store yet (no row in the
`items` table), its Buy button still opens the Etsy listing (Life RPG: its page). If Stripe ever refuses a checkout,
the buyer goes to Etsy instead of an error page.

**Fees.** Managed Payments costs 3.5% per sale on top of Stripe's normal 2.9% + 30¢ (US cards): about 55¢ on a
$3.99 sale. Lemon Squeezy would have taken 5% + 50¢ (about 70¢).

## What is already done

- The code: `src/store.js`, the download pages in `src/worker.js`, the tables in `src/schema.sql`, tests in
  `tools/store-test.mjs` (`node tools/store-test.mjs`: 29 tests).
- The database (Nov 16, 2026): the new tables `items`, `orders` and `activations` exist, and `items` lists the 15
  printables and the 2 packs with their Nov 11 PDFs, so those 17 can sell as soon as Stripe is connected.
- Life RPG (`life-rpg-sell`): checks keys from this store instead of Lemon Squeezy.
- Every Stone Speaks: its Buy buttons go to its Etsy listings until the store opens.

## What the owner does (about 30 minutes)

### 0. Put the new code live

The store's code waits on a branch (`ccr-85ba4867-31rc06`) in this repository and in life-rpg-sell. Tell Claude to
merge it into `main`; Cloudflare then deploys it. Nothing changes for visitors: the Buy buttons still go to Etsy.

### 1. Pick the Stripe account

Recommended: a **separate account for The Atlas of Cities under your same Stripe login**, not Vision Flooring LLC's
account. Vision Flooring's account carries Contractor Foreman's payments and the business's books; the Atlas
(and Every Stone Speaks, and Life RPG) sales stay cleaner on their own.

1. Open https://dashboard.stripe.com and sign in.
2. Click the account name at the top left, then **New account** (it may say **+ Create account**).
3. Name it **The Atlas of Cities** and finish **Activate payments**: business type, your details, bank account for
   payouts. (Lemon Squeezy's tax form was in your own name. Whether the Atlas should sell under your name or one of
   your LLCs is a question for your accountant.)
4. **Settings → Business → Public details**: set the **support email** (receipts show it, and the site tells buyers
   to write to "the support address on your payment receipt") and the **statement descriptor**, for example
   `ATLASOFCITIES`. With Managed Payments, card statements read `LINK.COM* ATLASOFCITIES`.

### 2. Turn on Managed Payments

1. Open https://dashboard.stripe.com/settings/managed-payments and follow the steps. Stripe reviews eligibility
   (US businesses selling digital products qualify).
2. If Stripe says no: tell Claude. The store can run without it (`STRIPE_MANAGED` "off" in `wrangler.jsonc`), but then
   you are the seller and handle sales tax yourself (Washington taxes digital products), with Stripe Tax as a helper.

### 3. Test mode first

1. In the dashboard, switch to **Test mode** (some accounts call it a **Sandbox**).
2. **Developers → API keys** → **+ Create restricted key**, "Building your own integration". Name it
   `atlasofcities.org`. Set these to **Write**: **Checkout Sessions**, **Products**, **Prices**. Leave everything
   else at None. Create it and copy the key (it starts with `rk_test_`).
3. **Workbench → Webhooks** (https://dashboard.stripe.com/test/workbench/webhooks) → **+ Add destination** →
   Events from **Your account** → tick `checkout.session.completed` and `checkout.session.async_payment_succeeded`
   → Continue → **Webhook endpoint** → URL `https://atlasofcities.org/stripe-webhook` → **Create destination**.
   Then click **Reveal** under Signing secret and copy it (starts with `whsec_`).
4. Cloudflare: https://dash.cloudflare.com → **Workers & Pages** → **atlasofcities** → **Settings** →
   **Variables and Secrets** → **+ Add**. Type **Secret**:
   - `STRIPE_TEST_KEY` = the `rk_test_` key
   - `STRIPE_TEST_WEBHOOK_SECRET` = the `whsec_` secret

   Click **Deploy**.
5. Try it: open `https://atlasofcities.org/buy/city-builders/?test=KEY`, where KEY is the private key in your
   numbers page's address (`/stats/KEY/`). Pay with card `4242 4242 4242 4242`, any future date, any CVC.
   You should land on a download page marked "TEST purchase", and the PDFs should download. Your numbers page lists
   the order as "(test)".
6. Life RPG: open `https://atlasofcities.org/buy/life-rpg/?test=KEY`, pay the same way, press **Open Life RPG** on
   the download page: the game unlocks.

### 4. Live mode

Same as step 3 with test mode switched **off**: a restricted key (`rk_live_`) and a live webhook to the same URL. In
Cloudflare add `STRIPE_KEY` and `STRIPE_WEBHOOK_SECRET`. The moment `STRIPE_KEY` is saved, `/buy/` addresses sell
for real, but the site's buttons still point to Etsy until step 5.

### 5. Open the store

Tell Claude "open the Stripe store". That is three small changes, each rebuilt and pushed:

- this site: `SHOP_VIA = 'stripe'` in `build/config.php` (every Buy button and the shop's wording switch to Stripe);
- Every Stone Speaks: `STORE_VIA = 'stripe'` in its `build/config.php`;
- Life RPG (`life-rpg-sell/wrangler.jsonc`): `BUY_URL` = `https://atlasofcities.org/buy/life-rpg/`, `TEST_KEYS` = "off".

Etsy keeps selling too: the listings stay up, and buyers who find them there still get Etsy's download.

## Every Stone Speaks' PDFs

The six packs are built in atlas-products (`bash make.sh esp-...`) and are not in the site's file store yet. Until
they are uploaded and listed in `items`, their Buy buttons keep going to Etsy, even after step 5. To add them:
upload each PDF with `PUT /dl/_put/<slug>-letter.pdf` and `-a4.pdf` (packs.sh does this with the upload key), then
add a row per pack to `items`, in the same shape as the packs' files:

```sql
INSERT OR REPLACE INTO items (slug, title, files) VALUES ('esp-advent', 'The Advent Walk',
  '[{"name":"The Advent Walk","note":"25 Advent day cards and a chart, 16 pages","letter":["esp-advent-letter.pdf",BYTES],"a4":["esp-advent-a4.pdf",BYTES]}]');
```

## When a product's PDFs are rebuilt

Upload the new PDFs under the same names (packs.sh `--upload`) and update the sizes in `items` (and `packs`). Buyers'
download pages show the new files at once; nobody needs a new link.

## Settings, in one place

| Where | Name | What |
|---|---|---|
| Cloudflare secret | `STRIPE_KEY` | live key, `rk_live_...` (or `sk_live_...`) |
| Cloudflare secret | `STRIPE_WEBHOOK_SECRET` | live webhook signing secret, `whsec_...` |
| Cloudflare secret | `STRIPE_TEST_KEY`, `STRIPE_TEST_WEBHOOK_SECRET` | the same for test mode |
| `wrangler.jsonc` | `STRIPE_MANAGED` | "on": Managed Payments (default) |
| `wrangler.jsonc` | `STRIPE_TAX` | "on": Stripe Tax, only when Managed Payments is off |
| `build/config.php` | `SHOP`, `STORE_ALSO`, `STORE_TAX` | names, prices, Etsy listings, tax categories |
| `build/config.php` | `SHOP_VIA` | `'etsy'` or `'stripe'`: where the site's Buy buttons go |
