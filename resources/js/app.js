import './bootstrap';

const cartDrawer = document.getElementById('order-cart-drawer');

if (cartDrawer) {
    const storageKey = 'urban-food-cart-v1';
    const body = document.body;
    const openButton = document.getElementById('cart-open');
    const closeButton = document.getElementById('cart-close');
    const overlay = document.getElementById('cart-overlay');
    const itemList = document.getElementById('cart-items');
    const emptyLabel = document.getElementById('cart-empty');
    const countLabel = document.getElementById('cart-count');
    const totalLabel = document.getElementById('cart-total');
    const noteInput = document.getElementById('cart-note');
    const clearButton = document.getElementById('cart-clear');
    const submitButton = document.getElementById('cart-submit');
    const messageBox = document.getElementById('cart-message');
    let cart = [];
    let note = '';
    let message = '';

    const money = (value) => `Gs. ${new Intl.NumberFormat('es-PY', { maximumFractionDigits: 0 }).format(Number(value) || 0)}`;

    function notify(text) {
        message = text;
        messageBox.textContent = text;
        messageBox.classList.toggle('hidden', !text);
    }

    function saveCart() {
        try {
            localStorage.setItem(storageKey, JSON.stringify({ items: cart, note }));
        } catch (error) {
            notify('No se pudo guardar el carrito en este navegador.');
        }
    }

    function loadCart() {
        try {
            const saved = JSON.parse(localStorage.getItem(storageKey) || '{}');
            note = typeof saved.note === 'string' ? saved.note.slice(0, 2000) : '';
            noteInput.value = note;
            if (!Array.isArray(saved.items)) return;

            cart = saved.items.filter((item) => item && Number(item.id) > 0 && Number(item.stock) >= 0)
                .map((item) => ({
                    id: Number(item.id),
                    name: String(item.name || ''),
                    price: Math.max(0, Number(item.price) || 0),
                    stock: Math.floor(Number(item.stock) || 0),
                    quantity: Math.min(Math.max(1, Math.floor(Number(item.quantity) || 1)), Math.floor(Number(item.stock) || 0)),
                }))
                .filter((item) => item.quantity > 0);
        } catch (error) {
            cart = [];
            note = '';
        }
    }

    function createButton(text, action, label, disabled = false) {
        const button = document.createElement('button');
        button.type = 'button';
        button.dataset.cartAction = action;
        button.setAttribute('aria-label', label);
        button.textContent = text;
        button.disabled = disabled;
        button.className = 'inline-flex h-8 min-w-8 items-center justify-center rounded-md border border-stone-700 px-2 text-sm text-stone-200 transition hover:border-brand-gold hover:text-brand-gold disabled:cursor-not-allowed disabled:opacity-40';
        return button;
    }

    function render() {
        itemList.replaceChildren();
        let total = 0;
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);

        cart.forEach((item) => {
            const subtotal = item.price * item.quantity;
            total += subtotal;

            const row = document.createElement('article');
            row.className = 'rounded-xl border border-stone-800 bg-stone-900/70 p-3';
            const top = document.createElement('div');
            top.className = 'flex items-start justify-between gap-3';
            const title = document.createElement('h3');
            title.className = 'font-medium text-white';
            title.textContent = item.name;
            const remove = createButton('Quitar', 'remove', `Quitar ${item.name}`, false);
            remove.className = 'text-xs text-stone-400 underline decoration-stone-700 underline-offset-4 transition hover:text-brand-gold';
            top.append(title, remove);

            const bottom = document.createElement('div');
            bottom.className = 'mt-3 flex items-center justify-between gap-3';
            const controls = document.createElement('div');
            controls.className = 'flex items-center gap-2';
            const minus = createButton('−', 'minus', `Reducir cantidad de ${item.name}`, item.quantity <= 1);
            const quantity = document.createElement('span');
            quantity.className = 'min-w-5 text-center text-sm tabular-nums text-stone-200';
            quantity.textContent = String(item.quantity);
            const plus = createButton('+', 'plus', `Aumentar cantidad de ${item.name}`, false);
            minus.dataset.id = String(item.id);
            plus.dataset.id = String(item.id);
            remove.dataset.id = String(item.id);
            controls.append(minus, quantity, plus);

            const amounts = document.createElement('div');
            amounts.className = 'text-right';
            const unit = document.createElement('p');
            unit.className = 'text-xs text-stone-400';
            unit.textContent = `${money(item.price)} c/u`;
            const line = document.createElement('p');
            line.className = 'font-medium tabular-nums text-brand-gold';
            line.textContent = money(subtotal);
            amounts.append(unit, line);
            bottom.append(controls, amounts);
            row.append(top, bottom);
            itemList.append(row);
        });

        countLabel.textContent = String(count);
        countLabel.classList.toggle('hidden', count === 0);
        openButton.setAttribute('aria-label', `Abrir carrito, ${count} productos`);
        totalLabel.textContent = money(total);
        emptyLabel.classList.toggle('hidden', cart.length !== 0);
        clearButton.disabled = cart.length === 0;
        submitButton.disabled = cart.length === 0;
    }

    function openCart() {
        overlay.classList.remove('hidden');
        cartDrawer.classList.remove('translate-x-full');
        cartDrawer.setAttribute('aria-hidden', 'false');
        openButton.setAttribute('aria-expanded', 'true');
        document.body.classList.add('overflow-hidden');
        closeButton.focus();
    }

    function closeCart() {
        cartDrawer.classList.add('translate-x-full');
        cartDrawer.setAttribute('aria-hidden', 'true');
        openButton.setAttribute('aria-expanded', 'false');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        openButton.focus();
    }

    loadCart();
    render();

    openButton.addEventListener('click', openCart);
    closeButton.addEventListener('click', closeCart);
    overlay.addEventListener('click', closeCart);

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && cartDrawer.getAttribute('aria-hidden') === 'false') closeCart();
    });

    document.querySelectorAll('[data-cart-add]').forEach((button) => {
        button.addEventListener('click', () => {
            const id = Number(button.dataset.id);
            const stock = Math.floor(Number(button.dataset.stock) || 0);
            const existing = cart.find((item) => item.id === id);

            if (stock < 1) return;
            if (existing && existing.quantity >= stock) {
                notify(`Solo hay ${stock} unidades disponibles de ${button.dataset.name}.`);
                openCart();
                return;
            }

            if (existing) {
                existing.quantity += 1;
                existing.stock = stock;
            } else {
                cart.push({ id, name: button.dataset.name, price: Number(button.dataset.price), quantity: 1, stock });
            }

            saveCart();
            render();
            notify(`${button.dataset.name} se agregó al carrito.`);
        });
    });

    itemList.addEventListener('click', (event) => {
        const button = event.target.closest('[data-cart-action]');
        if (!button) return;

        const item = cart.find((entry) => entry.id === Number(button.dataset.id));
        if (!item) return;

        if (button.dataset.cartAction === 'remove') cart = cart.filter((entry) => entry.id !== item.id);
        if (button.dataset.cartAction === 'minus' && item.quantity > 1) item.quantity -= 1;
        if (button.dataset.cartAction === 'plus') {
            if (item.quantity >= item.stock) {
                notify(`Solo hay ${item.stock} unidades disponibles de ${item.name}.`);
                return;
            }
            item.quantity += 1;
        }

        saveCart();
        render();
    });

    noteInput.addEventListener('input', () => {
        note = noteInput.value.slice(0, 2000);
        saveCart();
    });

    clearButton.addEventListener('click', () => {
        cart = [];
        note = '';
        noteInput.value = '';
        saveCart();
        render();
        notify('El carrito está vacío.');
    });

    submitButton.addEventListener('click', async () => {
        if (cart.length === 0) return;
        if (body.dataset.cartAuthenticated !== 'true') {
            window.location.assign(body.dataset.cartLoginUrl);
            return;
        }

        submitButton.disabled = true;
        notify('Enviando tu pedido…');

        try {
            const response = await fetch(body.dataset.cartSubmitUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    items: cart.map((item) => ({ id: item.id, cantidad: item.quantity })),
                    nota: note,
                }),
            });
            const result = await response.json();

            if (!response.ok) {
                const firstError = result.errors ? Object.values(result.errors).flat()[0] : null;
                throw new Error(firstError || result.message || 'No se pudo enviar el pedido.');
            }

            cart = [];
            note = '';
            noteInput.value = '';
            saveCart();
            render();
            notify(`¡Pedido #${result.numero} enviado! Total: ${money(result.total)}.`);
        } catch (error) {
            notify(error.message || 'No se pudo enviar el pedido. Inténtalo nuevamente.');
        } finally {
            submitButton.disabled = cart.length === 0;
        }
    });
}
