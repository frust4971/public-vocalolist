<template>
    <div class="row">
        <div class="dropdown text-right my-1  ml-lg-3 col-lg-7" v-if="type == 'year'">
        
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{params.year ? params.year:'年検索'}}
            </button>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" @click="search(0)">-</a>
                <a class="dropdown-item" href="#" v-for="y in years" :key="y" @click="search(y)">{{y}}</a>
            </div>
        
        </div>

        <div class="dropdown text-right my-1  ml-lg-3 col-lg-7" v-else>
            <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{getSortName(params.sort)}}
            </button>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" @click="sort('0')">投稿日順</a>
                <a class="dropdown-item" href="#" @click="sort('1')">再生回数順</a>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:['params','type'],
    data(){
        return {
            years : this.getYears()
        }
    },
    created(){
        console.log(this.type)
    },
    methods:{
        getSortName(sort){
            switch(sort){
                
                case '1':
                    return '再生回数順'
                default:
                    return '投稿日順'
            }
        },
        sort(sortId){
            let queries = {
                ...this.params,
                'sort': sortId
                };
            delete queries.page;
            this.$emit('load',queries);
        },
        getYears(){
            let years = [];
            let currentY = new Date().getFullYear();
            for(let y = currentY; y >= 2007; y--){
                years.push(y);
            }
            return years;
        },
        search(year){
            let queries = {
                ...this.params,
                'year': year
            };
            delete queries.page;
            this.$emit('load',queries);
        }
    }
}
</script>