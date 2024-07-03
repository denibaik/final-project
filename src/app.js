document.addEventListener("alpine:init", () => {
  Alpine.data("products", () => ({
    items: [
      {
        id: 1,
        name: "Sepatu Adidas Manchester",
        img: "adidas.jpg",
        price: 2000000,
      },
      {
        id: 2,
        name: "Crewneck Uniqlo",
        img: "uniqlo.jpg",
        price: 80000,
      },
      {
        id: 3,
        name: "Topi Supreme",
        img: "supreme.jpg",
        price: 150000,
      },
      {
        id: 4,
        name: "Hoodie Nike",
        img: "nike.jpg",
        price: 170000,
      },
      {
        id: 5,
        name: "Crewneck Stone Island",
        img: "si.jpg",
        price: 900000,
      },
      {
        id: 6,
        name: "Celana Dickies",
        img: "dickies.jpg",
        price: 200000,
      },
      {
        id: 7,
        name: "Hoodie Have a good time",
        img: "hagt.jpg",
        price: 350000,
      },
      {
        id: 8,
        name: "Longslevee Stripes Uniqlo",
        img: "stripe.jpg",
        price: 150000,
      },
      {
        id: 9,
        name: "Tshirt GNOBMEL - KRUCILS",
        img: "gnobmel.jpg",
        price: 70000,
      },
      {
        id: 10,
        name: "Hoodie Stussy",
        img: "stussy.jpg",
        price: 400000,
      },
    ],
  }));

  Alpine.store("cart", {
    items: [],
    total: 0,
    quantity: 0,
    add(newItem) {
      // cek apakah ada barang yang sama dicart
      const cartItem = this.items.find((item) => item.id === newItem);

      // jika belum ada / cart masih kosong
      if (!cartItem) {
        this.items.push({ ...newItem, quantity: 1, total: newItem.price });
        this.quantity++;
        this.total += newItem.price;
      } else {
        //jika barang sudah ada, cek
        this.items = this.items.map((item) => {
          //jika barang berbeda
          if (item.id !== newItem.id) {
            return item;
          } else {
            // jika barang sudah ada, tambah quantity dan total
            item.quantity++;
            item.total = item.price * item.quantity;
            this.quantity++;
            this.total += item.price;
            return item;
          }
        });
      }
    },
    remove(id) {
      //ambil item remove
      const cartItem = this.items.find((item) => item.id === id);

      //jika item lebih dari 1
      if (cartItem.quantity > 1) {
        //telusuri 1 1
        this.items = this.items.map((item) => {
          //jika bukan barang yang diklik
          if (item.id !== id) {
            return item;
          } else {
            item.quantity--;
            item.total = item.price * item.quantity;
            this.quantity--;
            this.total -= item.price;
            return item;
          }
        });
      } else if (cartItem.quantity === 1) {
        this.items = this.items.filter((item) => item.id !== id);
        this.quantity--;
        this.total -= cartItem.price;
      }
    },
  });
});

// konversi rupiah
const rupiah = (number) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  }).format(number);
};
