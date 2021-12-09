<template>
    <div class="row">
        <div class="pr-lg-0 col-12 col-lg-7 w-100 d-flex justify-content-center justify-content-lg-end">
            <ul class="pagination d-md-flex d-none">
                <li class="page-item" :class="{disabled: currentPage == 1}"  v-if="useEdgeLink==true"><a class="page-link" href="#" @click="change(1)">«</a></li>
                <li class="page-item" v-for="page in getPages(10)" :key="page"  :class="{active: page == currentPage}">
                    <a class="page-link" href="#" @click="change(page)">{{page}}</a>
                </li>
                <li class="page-item" :class="{disabled: currentPage == lastPage}" v-if="useEdgeLink==true"><a class="page-link" href="#" @click="change(lastPage)">»</a></li>
            </ul>
            <ul class="pagination d-md-none d-flex">
                <li class="page-item" :class="{disabled: currentPage == 1}"  v-if="useEdgeLink==true"><a class="page-link" href="#" @click="change(1)">«</a></li>
                <li class="page-item" v-for="page in getPages(smartphonePageLimit)" :key="page"  :class="{active: page == currentPage}">
                    <a class="page-link" href="#" @click="change(page)">{{page}}</a>
                </li>
                <li class="page-item" :class="{disabled: currentPage == lastPage}"  v-if="useEdgeLink==true"><a class="page-link" href="#" @click="change(lastPage)">»</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default{
    props:{
        'params': Object,
        'currentPage': Number,
        'lastPage': Number,
        'useEdgeLink': Boolean,
        'smartphonePageLimit': Number
        },
    methods:{
        change(page){
            let queries = {
                ...this.params,
                'page': page
                };
            this.$emit('load',queries);
        },
        
        getPages(limit_num){
            const LIMIT_NUM = limit_num;
            const HALF_LIMIT_NUM = Math.floor(LIMIT_NUM / 2);
            let start;
            let end;
            if(this.currentPage <= HALF_LIMIT_NUM){
                start = 1;
                end = LIMIT_NUM;
            }else if(this.currentPage >= this.lastPage - HALF_LIMIT_NUM){
                start = this.lastPage - LIMIT_NUM + 1;
                end = this.lastPage;
            }else{
                start = this.currentPage - (this.currentPage % 2 == 0 ? HALF_LIMIT_NUM - 1 : HALF_LIMIT_NUM);
                end = this.currentPage + HALF_LIMIT_NUM;
            }
            if(LIMIT_NUM > this.lastPage){
                end = this.lastPage;
            }
            let pages = [];
            for(let n = start; n < end + 1; n++){
                pages.push(n);
            }
            return pages;
        }
    }
}
</script>