<template>
    <div class="row">
        <div class="dropdown text-right my-1  ml-lg-3 col-lg-7">
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
    props:['params'],
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
            this.$emit('load',queries);
        }
    }
}
</script>