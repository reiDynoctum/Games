class PostLoader {
    #postsWrapper = document.getElementById('clanky');
    #buttonLoad = document.getElementById('nacti-clanky');
    #buttonNext = document.getElementById('dalsi');
    #buttonPrevious = document.getElementById('predchozi');
    #slug = this.#buttonLoad.dataset.slug ?? '';

    #generateApiUrl() {
        const currentPage = (new URLSearchParams(window.location.search)).get('page');
        const nextPage = currentPage ? parseInt(currentPage) + 1 : 2;

        return `https://127.0.0.1:8000/api/prispevky/${this.#slug}?page=${nextPage}`;
    }

    #generateWebAppUrl(page) {
        return `https://127.0.0.1:8000/prispevky/${this.#slug}?page=${page}`;
    }


    #generatePostElement(post) {
        const element = document.createElement('div');
        element.classList.add('karta-clanku');
        element.innerHTML = `<img src="${post.image}" alt="${post.name}">
            <div class="karta-textace">
                <h2>${post.name}</h2>
                <p>${post.content}</p>
                <p>
                    <a href="${post.url}">Přečíst</a>
                </p>
            </div>`;

        return element;
    }

    #updateButtons(paginationData) {
        if (!paginationData.hasNextPage) {
            this.#buttonLoad.remove();
            this.#buttonNext.setAttribute('aria-disabled', true);
            this.#buttonNext.classList.add('vypnuto');
        } else {
            console.log(this.#buttonNext);
            this.#buttonNext.setAttribute('href', this.#generateWebAppUrl(paginationData.nextPage));
        }

        if (paginationData.hasPreviousPage) {
            console.log(this.#buttonPrevious);
            this.#buttonPrevious.classList.remove('vypnuto');
            this.#buttonPrevious.setAttribute('aria-disabled', false);
            this.#buttonPrevious.setAttribute('href', this.#generateWebAppUrl(paginationData.previousPage));
        }
    }

    #processPostsData(data) {
        const { posts, pagination } = data;

        posts.forEach((post) => {
            this.#postsWrapper.append(this.#generatePostElement(post));
        })

        this.#updateButtons(pagination);

        window.history.replaceState(null, '', this.#generateWebAppUrl(pagination.nextPage - 1));
    }

    loadPosts() {
        fetch(this.#generateApiUrl())
            .then(response => response.json())
            .then(data => this.#processPostsData(data));
    }
}

const loadPostsButton = document.getElementById('nacti-clanky');

if (loadPostsButton) {
    const postLoader = new PostLoader();
    loadPostsButton.addEventListener('click', () => postLoader.loadPosts());
}
