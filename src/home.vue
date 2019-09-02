<template>
    <div class="main-content-wrap">
        <div class="main-content">
            
                
            <div class="left-input-div">
                <div class="top-side-img">
                    <img class="top-side-img-img" src="./assets/images/topside.png">
                </div>
                <div class="status-img">
                    <img v-bind:src="'dist/'+statusImg">
                </div>
                <div class="curent-status">
                    <p><span>Status:-</span> <span>{{ status }}</span></p>
                </div>

                <!--input form-->
                <form v-on:submit.prevent="sPass" >
                    <input v-model.trim="pass.md5" class="hash-input" type="text" name="input-hash"  placeholder="insert your md5 hash">
                    <button v-on:click.prevent="sPass" class="hash-button" type="submit">Crack</button>
                </form>	
            </div>

            <hr>

            <div class="right-output-div">

                <div class="output-img">
                    <img v-bind:src="'dist/'+outImg">
                </div>
                <div class="output-status">
                    <p> {{ outStat }} </p>
                </div>
                <div v-if="password" class="passD">
                    <p>{{ password }}</p>
                </div>

                
            </div>


            
        </div>

    </div>
</template>

<script>
export default {
    data () {
        return {
            statusImg: "load-stop.png",
            status:"insert a hash first..!!",
            outImg: "looos.png",
            outStat:"insert a hash first..!!",
            password: "",
            pass:{
                md5:""
            }
        }
    },
    methods:{
        sPass: function(){
            if (this.pass.md5 !=''){
                this.pass.md5= this.pass.md5.replace(/[^0-9-a-z-A-Z]+/g, '');
                this.statusImg="load.gif";
                this.status="loading...";
                this.password= "";
                this.outStat= "loading..!";

                this.$http.get('http://localhost/hash-crack-api/api/'+this.pass.md5).then( function(data) {
                    this.statusImg="load-stop.png";
                    

                    if(data.body.type== 'success'){
                        this.outStat= "password cracked..!";
                        this.password= data.body.password;
                        this.outImg= "success.png";
                        this.status="cracked..!";
                    }else{
                        this.outStat= data.body.msg;
                        this.status="fucked..!";
                        this.outImg= "looos.png";
                    }
                    
                });

            }
            

            
        }
    }
}
</script>

<style>

</style>
