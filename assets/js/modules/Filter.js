/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLFormElement} form
 */
export default class Filter {
    
    /**
     * 
     * @param {HTMLElement|null} element 
     */
    constructor(element){
        if(element === null){
            return
        }

        this.pagination = element.querySelector('js-filter-pagination')
        this.content = element.querySelector('js-filter-content')
        this.form = element.querySelector('js-filter-form')
        this.bindEvents()
    }
        
    bindEvents() {
        this.form.addEventListener('click', e => {
            if(e.target.tagName === 'A'){
                e.preventDefault()
                this.loardUrl(e.target.getAttribute('ht'))
            }
        })
        this.form.querySelectorAll('input[type=checkbox]').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this))
        })
    }

    async loadForm(){
        const data = new FormData(this.form)
        const url = new URL(this.form.getAttribute('action') || window.location.href)
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            params.append(key, value)
        })
        debbuger
    }

    async loardUrl(url){
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if(response.status >= 200 && response.status < 300){
            const data = await response.json()
            this.content.innerHTML = data.content
            history.replaceState({}, '', url)
        }else{
            console.error(response)
        }
    }
}